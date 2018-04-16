<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
	<form method="POST" action="adminHome.php">
		
	
	<table>
		
			<tr>
				<td>Username:</td>
				<td><input type="text" name="adminUsername"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="adminPassword"></td>

			</tr>


		</table>
			<input type="submit" name="signin" id="signin" value="Sign In">
	</form>


	





</body>
</html>