<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
	<header>
		
	</header>
	<form method="POST" action="verify.php">
	
		<table>
		
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password"></td>

			</tr>


		</table>
			<input type="submit" name="signin" id="signin" value="Sign In" class="buttons">
			<p class="center">Don't have an account? Sign up <a id="notWhite" href="signup.php">here</a></p>
	</form>
	<?php



	?>
</body>
</html>