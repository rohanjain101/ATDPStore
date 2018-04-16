<!DOCTYPE html>
<html>
<head>
	<title>Store</title>
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
			<td><input type="submit" name="searchButton" id="searchButton" value="Search" class="buttons"></tr>
			</tr>
		</table>



	</form>
	<?php
		
		require_once 'rohanConfig.php';
		$searchTerm = htmlspecialchars($_GET["search"]);

	


		$blank = true;
		try 
		{
			$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

			if($searchTerm == "")
			{

				$sth = $dbh -> prepare("SELECT * FROM products");
				$blank = true;
			}
			else
			{
				$sth = $dbh -> prepare("SELECT * FROM products WHERE name LIKE '%$searchTerm%'");
				$blank = false;
			}
			
			$sth -> execute();
			$info = $sth ->fetchAll();
			
			$names = array();
			$description =  array();
			$location = array();
			$id = array();

			for($i = 0; $i < count($info); $i++)
			{
				$names[$i] = $info[$i]["name"];
				$description[$i] = $info[$i]["description"];
				$location[$i] = $info[$i]["location"];
				$id[$i] = $info[$i]["productID"];
			}

			$numProducts = count($id);
			if($blank)
			{
				echo "<table class=\"centerTable\">";
				echo "<tr>";
				for($i = 0; $i < 9; $i++)
				{
					
					if($i%3==0)
					{
						echo "<tr>";
					}
					echo "<td><a href=\"description.php?id={$id[$i]}\"><img src=\"{$location[$i]}\" alt=\"{$location[$i]}\" width=\"220\" class=\"imageCenter\"></a></td>";//IMAGES GOTTEN FROM fotolia.com

				}
				echo "</table>";
			}
			else
			{
				
				for($i = 0; $i < count($info);$i++)
				{
					$name[$i] = $info[$i]["name"];
					$location[$i] = $info[$i]["location"];
					$description[$i] = $info[$i]["description"];
					$id[$i] = $info[$i]["productID"];
				}
				if(count($name) == 1)
				{
					echo "<p class=\"match\">Found ".count($name)." match for ".$searchTerm."</p>";	
				}
				else
				{
					echo "<p class=\"match\">Found ".count($name)." matches for ".$searchTerm."</p>";					}
				
				for($i = 0; $i < count($names);$i++)
				{

				if($i%3==0)
				{
					echo "<br>";
				}
					echo "<td><a href=\"description.php?id={$id[$i]}\"><img src=\"{$location[$i]}\" alt=\"{$location[$i]}\" width=\"220\" class=\"imageCenter\"></a></td>";//IMAGES GOTTEN FROM fotolia.com

				}
				
					
				}
				
			}

			
		
		catch (PDOException $e) 
		{
			echo "Error connecting to data base.";
		}
	?>

</body>
</html>