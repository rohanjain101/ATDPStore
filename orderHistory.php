<?php
	session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Order History</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>

<header>
	
</header>
<?php

	$searchKey = htmlspecialchars($_POST["searchBar"]);
	require_once 'rohanConfig.php';
	$sort = 1;
	$submit = $_POST["resort"];
	$search = $_POST["searchButton"];
	if($submit)
	{
		$sort = $_POST["orderBy"];

	}
	$orderString="";
	if($sort == 0)
	{
		$orderString = " ORDER BY order.orderID ASC";
	}
	elseif($sort == 1)
	{
		$orderString = " ORDER BY order.orderID DESC";
	}
	elseif($sort==2)
	{

		$orderString = " ORDER BY order.totalPrice ASC";
	}
	else
	{
		$orderString = " ORDER BY order.totalPrice DESC";
	}



	require_once 'rohanConfig.php';
	$customerID = $_SESSION["customerID"];
	echo "<form action=\"orderHistory.php\" method=\"POST\">";
	echo "<table class=\"sortTable\">";
	echo "<tr>";
	echo "<td><input type=\"search\" name=\"searchBar\" value={$searchKey}></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><select name=\"orderBy\">";
	echo "<option value=\"0\"";
	if ($sort == 0) {
		echo " selected";
	}
	echo ">Date Ascending</option>";
	


	echo "<option value=\"1\"";
	if ($sort == 1) {
		echo " selected";
	}
	echo ">Date Descending</option>";

	echo "<option value=\"2\"";
	if ($sort == 2) {
		echo " selected";
	}
	echo ">Total Cost Ascending</option>";

	echo "<option value=\"3\"";
	if ($sort == 3) {
		echo " selected";
	}
	echo ">Total Cost Descending</option>";



	echo "</td>";
	echo "</select>";
	echo "<td>  <input type=\"submit\" name=\"resort\" value=\"Sort\" class=\"smallerButtons\"></td>";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
	

	try
	{
		
		$selectString = "";
		if($searchKey == "")
		{ 
			$selectString = "SELECT * FROM `order` WHERE customerID = :customerID";
		}	
		else
		{
			$selectString = "SELECT * FROM `order` INNER JOIN `orderItems` ON order.orderID = orderItems.orderID INNER JOIN `products` ON products.productID = orderItems.productID
WHERE name LIKE '%{$searchKey}%' AND customerID = :customerID";

		}
			$sqlString = $selectString.$orderString;
			$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
			$sth = $dbh->prepare("{$sqlString}");
			$sth->bindValue(':customerID',$_SESSION["customerID"]);
			
			$sth->execute();
			$orders = $sth->fetchAll();


		$date = array();
		$totalPrice  = array();
		$orderIDs = array();
		for($i = 0; $i < count($orders); $i++)
		{
			$orderIDs[$i] = $orders[$i]["orderID"];
			$date[$i] = $orders[$i]["created_date"];
			$totalPrice[$i] = $orders[$i]["totalPrice"];
		}


		$products = array();
		for($i = 0; $i<count($orderIDs);$i++)
		{
			$sth = $dbh->prepare("SELECT orderItems.productID,products.name, products.location, orderItems.price,orderItems.quantity FROM orderItems INNER JOIN `products` ON orderItems.productID= products.productID WHERE orderID = :orderID");
			$sth->bindValue(':orderID',$orderIDs[$i]);
			$sth->execute();
			$products = $sth->fetchAll();


			if(count($products)>0)
			{


				$sth = $dbh->prepare("SELECT totalPrice FROM `order` WHERE orderID = :orderID");
				$sth->bindValue(':orderID',$orderIDs[$i]);
				$sth->execute();
				$prices = $sth->fetch();
					
				$finalCost = $prices["totalPrice"];



				echo "<table class=\"topTable\">";
				echo "<tr>";
				echo "<td>Order ID <br> {$orderIDs[$i]}</td>";
				echo "<td>Date Placed <br> {$date[$i]}</td>";
				echo "<td>Total With Tax<br> {$finalCost}</td>";
				echo "</tr>";
				echo "</table>";



				echo "<table class=\"cartTable\">";
				echo "<tr>";
				echo "<th>Product Image</th>";
				echo "<th>Product Name</th>";
				echo "<th>Quantity</th>";
				echo "<th>Unit Price</th>";
				echo "<th>Total Price</th>";
				echo "</tr>";

				for($j = 0; $j < count($products);$j++)
				{
					echo "<tr>";
					$id= $products[$j]["productID"];
					$amount = $products[$j]["quantity"];
					$unitPrice = $products[$j]["price"];
					$location = $products[$j]["location"];

					$totalProductPrice = $products[$j]["price"]* $products[$j]["quantity"];
					$name = $products[$j]["name"];






					echo "<td><a href=\"description.php?id={$id}\"><img src=\"{$location}\" height=\"60\"></a></td>";
					echo "<td><a href=\"description.php?id={$id}\" class=\"orderLink\">{$name}</a></td>";
					echo "<td>{$amount}</td>";
					echo "<td>{$unitPrice}</td>";
					echo "<td>{$totalProductPrice}</td>";
					echo "</tr>";
				}

			}

				echo "</table>";
		}
	}
	catch(PDOException $e)
	{
		echo "Error";
	}
?>
</body>
</html>