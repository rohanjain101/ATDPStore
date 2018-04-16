<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
	<header>
		
	</header>
	<h1 id="final">Final Order</h1>
	<p class="center">Your order has been successfully placed.</p>

	<?php

	echo "<form action=\"cart.php\" method=\"POST\">";
		echo "<table class=\"cartTable\">";
		echo "<tr>";
		echo "<th>Product Image</th>";
		echo "<th>Name</th>";
		echo "<th>Unit Price</th>";
		echo "<th>Quantity</th>";
		echo "<th>Total Price</th>";

		echo "</tr>";
		require_once 'rohanConfig.php';
		$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
		for($i = 0; $i < count($_SESSION["price"]);$i++)
		{

			$sth = $dbh->prepare("SELECT name,location FROM products WHERE productID = :productID");	
			// echo $_SESSION["prodID"][$i];	
			$sth ->bindValue(':productID',$_SESSION["prodID"][$i]);		
			$sth->execute();
			$name = $sth->fetch();
			$location = $name["location"];
			$productID = $_SESSION["prodID"][$i];

			$totalPrice = $_SESSION["price"][$i]*$_SESSION["quantity"][$i];
			$total = $_SESSION["price"][$i];

			$amount = $_SESSION["quantity"][$i];
			$taxAmount +=$totalPrice;
			
				if($_SESSION["quantity"][$i]!=0)
				{
					echo "<tr>";
					echo "<td><a href=\"description.php?id={$productID}\"><img src=\"{$location}\" height=\"60\"></a></td>";
					echo "<td><a href=\"description.php?id={$productID}\" class=\"orderLink\">{$name[0]}</a></td>";
					echo "<td>{$total}</td>";
					echo "<td>{$amount}</td>";
					echo "<td>{$totalPrice}</td>";

					echo "</tr>";
				}
	
	
		}
		$withTax = ((7.5/100)+1)*$taxAmount;
		$withTax = round($withTax,2);
		echo "<tr>";
		echo "<th><Totals:/th>";
		echo "<td>Total Cost: {$taxAmount}</td>";
		echo "<td>Total With Tax: {$withTax}</td>";
		echo "<td></td>";
			echo "<td></td>";
		echo "</tr>";
		echo "</table>";
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
		$custID = $_SESSION["customerID"];
		
			$sth = $dbh->prepare("INSERT INTO `order` (`customerID`, `totalPrice`) VALUES(:custID, :totalPrice);");
			$sth->bindValue(':custID',$custID);
			$sth->bindValue(':totalPrice',$withTax);
			$y = $sth->execute();

	
			$sth = $dbh->prepare("SELECT MAX(orderID) FROM `order`;");
			$x = $sth->execute();
			$orderID = $sth->fetch();
			$id = $orderID["MAX(orderID)"];
	
			

		for($i = 0; $i < count($_SESSION["quantity"]);$i++)
		{
			if($_SESSION["quantity"][$i]!=0)
			{

				$sth = $dbh->prepare("INSERT INTO `orderItems`(`orderID`, `productID`, `quantity`, `price`) VALUES(:orderID, :productID, :quantity, :price);");
				$sth->bindValue(':orderID',$id);
				$sth->bindValue(':productID',$_SESSION["prodID"][$i]);
				$sth->bindValue(':quantity',$_SESSION["quantity"][$i]);
				$sth->bindValue(':price',$_SESSION["price"][$i]);
				$sth->execute();

			}
		}

		
		$sth = $dbh->prepare("DELETE FROM cart WHERE customerID = :customerID");

		$sth->bindValue(':customerID', $_SESSION["customerID"]);
		$sth->execute();
		$_SESSION["quantity"] = array();
		$_SESSION["prodID"] = array();
		$_SESSION["price"] = array();



	?>
	
</body>
</html>