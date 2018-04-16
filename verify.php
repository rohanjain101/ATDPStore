<?php
	session_start();

		function sentToCart()
		{
			header('Location:http://atdplogs.berkeley.edu/rjain/Store/cart.php');
			$_SESSION["sentToLogin"] = false;
			exit;
		}
		function goToStore()
		{
		
				header('Location: http://atdplogs.berkeley.edu/rjain/Store/store.php');
				exit;
			
	

		}
		function retry()
		{
			header('Location:http://atdplogs.berkeley.edu/rjain/Store/signin.php');
		}
		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);
		
		
		
		require_once 'rohanConfig.php';
		try
		{
			
				$dbh = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
				$sth = $dbh->prepare("SELECT customerID FROM customer WHERE username = :username");
				$sth->bindValue(':username',$username);
				$sth->execute();
				$customerID = $sth->fetch();
				$sth = $dbh->prepare("SELECT password FROM customer WHERE username = :username");
				$sth->bindValue(':username',$username);
				$sth->execute();
				$passwordHash = $sth->fetch();
				$hash = $passwordHash["password"];
				


				$customerID = $customerID["customerID"];
				$_SESSION["customerID"] = $customerID;
				

					
				if(password_verify($password,$hash))
				{
					
					$login = true;
					
					
				}
				else
				{

					$login = false;
					
					$_SESSION["loggedIn"] = false;
					retry();
					
				}
			if($login)
			{
				$_SESSION["quantity"] = array();
				$_SESSION["prodID"] = array();
				$_SESSION["price"] = array();
				$_SESSION["loggedIn"] = true;

				$sth = $dbh-> prepare("SELECT products.price,cart.quantity,cart.productID FROM `cart` INNER JOIN `products` ON cart.productID = products.productID WHERE customerID =:customerID");
				$sth->bindValue(':customerID',$customerID);
				$sth->execute();
				$info = $sth->fetchAll();

				for($i = 0; $i < count($info);$i++)
				{
			
					$_SESSION["quantity"][$i] = intval($info[$i]["quantity"]);

					$_SESSION["prodID"][$i] = intval($info[$i]["productID"]);

					$_SESSION["price"][$i] = floatval($info[$i]["price"]);

				}

				$sth = $dbh->prepare("SELECT name,isAdmin FROM `customer` WHERE customerID = :customerID");
				$sth->bindValue(':customerID',$customerID);
				$sth->execute();
				$name = $sth->fetch();
			
				$customerName = $name["name"];
				$_SESSION["customerName"] = $customerName;
				$isAdmin = $name["isAdmin"];
				$_SESSION["isAdmin"] = $isAdmin;
	
				
				if($_SESSION["sentToLogin"])
				{
					$_SESSION["sentToLogin"] = true;
					sentToCart();
				}
				goToStore();
			}	


			}
			catch(PDOException $e)
			{
				echo "Error";
			}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Verify</title>
</head>
<body>
	<?php
	


		
?>

</body>
</html>