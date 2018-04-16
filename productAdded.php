<?php
	require_once 'rohanConfig.php';
	$name = htmlspecialchars($_POST["name"]);
	$price = htmlspecialchars($_POST["price"]);
	$description = htmlspecialchars($_POST["description"]);
	$location = htmlentities($_POST["url"]);
	function redirect()
	{
		header('Location: http://atdplogs.berkeley.edu/rjain/Store/store.php');
	}
	//UPLOADING FILE CODE TAKEN FROM http://www.tutorialspoint.com/php/php_file_uploading.htm
 

	try
	{
		$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
		$sth = $dbh->prepare("INSERT INTO `products`(`name`, `description`, `location`, `price`) VALUES(:name, :description, :location,:price);");
		$sth->bindValue(':name',$name);
		$sth->bindValue(':description',$description);
		$sth->bindValue(':location',$location);
		$sth->bindValue(':price',$price);
		$sth->execute();
		redirect();
	}
	catch(PDOException $e)
	{
		echo "Error";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Added!</title>
</head>
<body>

</body>
</html>