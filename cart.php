<?php
	session_start();
	
	if(count($_SESSION) == 0)
	{
		header('Location: http://atdplogs.berkeley.edu/rjain/Store/signin.php');
		$_SESSION["sentToLogin"] = true;

	}
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
	<?php
	require_once 'rohanConfig.php';
	try
	{
			$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
		// $dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
		// $sth = $dbh->prepare("TRUNCATE TABLE cart;");
		// $sth->execute();
		echo "<h1 id=\"cartHeader\" class=\"center\">Your Cart</h1>";
		$quantity = htmlspecialchars($_GET["quant"]);
		$id = htmlspecialchars($_GET["prodName"]);
		$price = htmlspecialchars($_GET["price"]);
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';//chceck to see if page had been refreshed. Without this, last product would be added to cart again every time page was refreshed.
		if($pageWasRefreshed) 
		{
   			$quantity = "";
   			$id = "";
   			$price="";

		} 
				// 		$_SESSION["quantity"] = array();
				// $_SESSION["prodID"] = array();
				// $_SESSION["price"] = array();
		$index = 0;
		

		if(in_array($id, $_SESSION["prodID"]))
		{
			for($i = 0; $i < count($_SESSION["prodID"]);$i++)
			{
				if($id == $_SESSION["prodID"][$i])
				{
					$index = $i;
					break;
				}
			}
			echo "<br><br>";
			$currentQuant = $_SESSION["quantity"][$index];
			$currentQuant = intval($currentQuant);
			$currentQuant+=$quantity;

			$currentPrice = $_SESSION["price"][$index];
			$currentPrice = floatval($currentPrice);
			$currentPrice = $price;


			 $_SESSION["quantity"][$index] = $currentQuant;
			 $_SESSION["price"][$index] = $currentPrice;
			echo "<br><br>";
		}

		else
		{
			if($id!=0)
			{
				$_SESSION["prodID"][] = intval($id);
			}
			
			if(intval($quantity)!=0)
			{
				$_SESSION["quantity"][] = intval($quantity);
			}
			if(floatval($price)!=0)
			{
				$_SESSION["price"][] = floatval($price);
			}
			
		}

	

		$submit = $_POST["submit"];
		if($submit)
		{
			
			for($i = 0; $i < count($_SESSION["quantity"]);$i++)
			{
				$_SESSION["quantity"][$i] = htmlspecialchars(intval($_POST["{$i}"]));
				
			}
			
		}

		for($i = 0; $i<count($_SESSION["quantity"]);$i++)
		{
			$delButton = htmlspecialchars($_POST["{$i}del"]);
			
			if($delButton)
			{
				$_SESSION["quantity"][$i] = 0;

			}
		}
		echo "<form action=\"cart.php\" method=\"POST\">";
		echo "<table  class=\"cartTable\">";
		echo "<tr>";
		echo "<th>Image</th>";
		echo "<th>Name</th>";
		echo "<th cl>Unit Price</th>";
		echo "<th>Quantity</th>";
		echo "<th>Total Price</th>";
		echo "<th>Edit Quantity</th>";
		echo "<th>Delete Item</th>";
		echo "</tr>";

		$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
		for($i = 0; $i < count($_SESSION["price"]);$i++)
		{

			$sth = $dbh->prepare("SELECT name,location FROM products WHERE productID = :productID");	
			// echo $_SESSION["prodID"][$i];	
			$sth ->bindValue(':productID',$_SESSION["prodID"][$i]);		
			$sth->execute();
			$name = $sth->fetch();
			$location = $name["location"];
			
			$totalPrice = $_SESSION["price"][$i]*$_SESSION["quantity"][$i];
			$total = $_SESSION["price"][$i];

			$amount = $_SESSION["quantity"][$i];

			if($_SESSION["quantity"][$i]!=0)
			{
				$productID = $_SESSION["prodID"][$i];
				echo "<tr>";
				echo "<td><a href=\"description.php?id={$productID}\"><img src=\"{$location}\" height=\"60\"></a></td>";
				echo "<td><a href=\"description.php?id={$productID}\" class=\"orderLink\">{$name[0]}</a></td>";
				echo "<td>{$total}</td>";
				echo "<td>{$amount}</td>";
				echo "<td>{$totalPrice}</td>";
				echo "<td><input type=\"number\" value=\"$amount\" name=\"{$i}\" class=\"reduce\"> ";
				echo "<input type=\"submit\" name=\"submit\" value=\"Update\" class=\"smallButtons\"></td>";
				echo "<td><input type=\"submit\" name=\"{$i}del\" value=\"Delete Item\" class=\"smallButtons\"></td>";
				echo "</tr>";
			}
			// else
			// {
			// 	echo "Not Set<br>";
			// }

		}
	
		echo "</table>";
		echo "</form>";
		
		
		$sth = $dbh->prepare("TRUNCATE TABLE cart;");
		$sth->execute();
		echo "<br><br>";

		echo "<form action=\"checkout.php\"  method=\"POST\">";
		echo "<table class=\"cartButtons\">";
		echo "<tr>";
		echo "<td><input type=\"button\" value=\"Continue Shopping\" onclick=\"location='store.php'\" class=\"buttons\"></td>";
		echo "<td><input type=\"submit\" value=\"Proceed To Checkout\" class=\"buttons\"></td>";
		echo "</tr>";
		echo "</table>";
		echo "</form>";
	
		$customerID = $_SESSION["customerID"];
		$customerID = intval($customerID);
		
	for($i = 0; $i<count($_SESSION["price"]);$i++)
	{
		if($_SESSION["quantity"][$i]!=0)
		{
			$sth = $dbh->prepare("INSERT INTO `cart`(`productID`, `quantity`, `customerID`) VALUES(:productID, :quantity, :customerID);");

			$sth->bindValue(':productID',$_SESSION["prodID"][$i]);
			$sth->bindValue(':quantity',$_SESSION["quantity"][$i]);
			$sth->bindValue(':customerID',$customerID);
			$sth->execute();
			
		}

	}

	}
	catch(PODException $e)
	{
		echo "Error";
	}
	// <input type="button" value="Say Hi!" onclick="location='test.php'" />

	
?>



</body>
</html>