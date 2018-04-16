<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>

<header>
	
</header>
 	<?php

 	?>
 	<form action="signedup.php" method="POST">

 		<table>
 			<tr>
 				<td>First and Last Name</td>
 				<td><input type="text" name="name" required></td>
 			</tr>
 			<tr>
 				<td>Address</td>
 				<td><input type="text" name="address" required></td>
 			</tr>
 			<tr>
 				<td>Date of Birth</td>
 				<td><input type="date" name="bday" required></td>
 			</tr>
 			<tr>
 				<td>Email</td>
 				<td><input type="email" name="email" required></td>
 			</tr>
 			 <tr>
 				<td>Username</td>
 				<td><input type="text" name="username" required></td>
 			</tr>
 			  <tr>
 				<td>Password</td>
 				<td><input type="password" name="password" required></td>
 			</tr>
 			 <tr>
 				<td>Gender</td>
 				<td><p><input type="radio" name="gender" value="male" required>Male</p>
 					<label><input type="radio" name="gender" value="female">Female</label>
 				</td>
 			</tr>
 			


 		</table>
 		<input type="submit" name="signup" value="Sign Up!" id="signUp" class="buttons">
 	</form>
</body>
</html>