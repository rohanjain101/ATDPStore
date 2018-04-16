<!DOCTYPE html>
<html>
<head>
	<title>Create a New Product</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
<header>
	
</header>
	<?php
		echo "<form method=\"POST\" action=\"productAdded.php\" enctype=\"multipart/form-data\">";
		echo "<table class=\"hide\">";
		echo "<tr>";
			echo "<td>Name</td>";
			echo "<td><input type=\"text\" name=\"name\" required></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Description</td>";
			echo "<td><textarea type=\"text\" name=\"description\" required></textarea></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Insert the URL</td>";
			echo "<td><input type=\"text\" name=\"url\" id=\"text\" required></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Price</td>";
			echo "<td><input type=\"number\" name=\"price\" step=\"any\" required></td>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=\"submit\" name=\"submit\" id=\"newProduct\" class=\"buttons\" style=\"display:block; margin-left:auto; margin-right:auto; margin-top:1em;\" required>";
		echo "</form>";


	?>
</body>
</html>