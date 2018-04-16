<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Description</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
	
<header>
	
</header>
	<form action="store.php" method="GET">
		<table class="searchTable">
			<tr>
			<td><input type="search" name="search" value="" id="searchBar"></td>
			<td><input type="submit" name="searchButton" id="searchButton" value="Search" class="buttons"></td>
			</tr>
		</table>
		</form>
 	
 	<?php
 	require_once 'rohanConfig.php';
 	try
 	{
 		 $id = htmlspecialchars($_GET["id"]);
	 		
 		$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
		 $sth = $dbh -> prepare("SELECT * FROM products WHERE products.productID = :productID");

		$sth -> bindValue(':productID',$id);
		$sth -> execute();
		$info = $sth ->fetch();
		

		
		$names = $info["name"];
		
		$description = $info["description"];
		$location = $info["location"];
		$price = $info["price"];
		echo "<form action=\"cart.php\" method=\"GET\">";
		echo "<input type=\"hidden\" value=\"{$id}\" name=\"prodName\">";
		echo "<input type=\"hidden\" value=\"{$price}\" name=\"price\">";

	

		echo "<table>";
		echo "<tr>";
		echo "<td><img src=\"{$location}\" width=\"400\" id=\"descrip\"></td>";
		echo "<td class=\"title\"><p id=\"top\">{$names}</p>";
		echo "Price: {$price}<br>";
		echo "{$description}<br>";

		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td></td>";
		echo "<td>";
		echo "<div id=\"select\">";
		echo "Quantity<br>";
		echo "<select name=\"quant\" id=\"dropdown\">";
		for($i = 1; $i < 11;$i++)
		{
			echo "<option value=\"{$i}\">{$i}</option>";
		}
		echo "</select>";
		echo "<input type=\"submit\" value=\"Add to Cart\" class=\"buttons\">";
		echo "</div>";
		echo "</td>";
		echo "</tr>";

		echo "</table>";
		
		echo "</form>";
 	}
 	catch(PDOException $e)
 	{
 		echo "error";
 	}


 	?>

</body>
</html>