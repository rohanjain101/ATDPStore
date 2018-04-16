<?php
		// function rename()
		// {
		// 	header('Location: http://atdplogs.berkeley.edu/rjain/Store/signup.php');
		// }
		session_start();
		function redirect()
		{
			header('Location: http://atdplogs.berkeley.edu/rjain/Store/store.php');
		}
		function signup()
		{
			header('Location: http://atdplogs.berkeley.edu/rjain/Store/signup.php');
			exit;
		}

		require_once 'rohanConfig.php';
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
		$name = htmlspecialchars($_POST["name"]);
		$address = htmlspecialchars($_POST["address"]);
		$dob = htmlspecialchars($_POST["bday"]);
		$email = htmlspecialchars($_POST["email"]);
		$gender = htmlspecialchars($_POST["gender"]);
		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);
		$hash = password_hash($password, PASSWORD_DEFAULT);


		try
		{
			
					$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
					$sth = $dbh->prepare("SELECT username FROM customer");
					$sth->execute();
					$names = $sth->fetchAll();
					// var_dump($names);
					$dataNames = array();
					for($i=0;$i < count($names);$i++)
					{
						$dataNames[$i] = $names[$i]["username"];
					}
				

					if(in_array($username, $dataNames))
					{
						signup();
						
					}

					$sth = $dbh -> prepare("INSERT INTO `customer` (`name`, `address`, `dob`, `gender`, `username`, `password`) VALUES(:name, :address, :dob, :gender, :username, :hash);");
					$sth->bindValue(':name',$name);
					$sth->bindValue(':address',$address);
					$sth->bindValue(':dob',$dob);
					$sth->bindValue(':gender',$gender);
					$sth->bindValue(':username',$username);
					$sth->bindValue(':hash',$hash);
					$sth -> execute();

				


				$_SESSION["quantity"] = array();
				$_SESSION["prodID"] = array();
				$_SESSION["price"] = array();
				$_SESSION["loggedIn"] = true;


				$_SESSION["customerName"] = $name;
				
				require_once 'rohanConfig.php';
				try
				{
						$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
						$sth = $dbh->prepare("SELECT customerID FROM `customer` WHERE username=:username");
						$sth->bindValue(':username',$username);
						$sth->execute();
						$id = $sth->fetch();
						$customerID = $id["customerID"];
						$_SESSION["customerID"] = $customerID;
				}
				catch(PDOException $e)
				{
					echo "Error";
				}
				
				if($_SESSION["sentToLogin"])
				{
					$_SESSION["sentToLogin"] = true;
					sentToCart();
				}

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
	<title>Signued Up!</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
</head>
<body>
<header>
	
</header>
	
</body>
</html>