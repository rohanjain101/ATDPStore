<?php
		session_start();


		$_SESSION = array();


		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		// Finally, destroy the session.
		session_destroy();
		redirect();

	function redirect()
	{
		header('Location:http://atdplogs.berkeley.edu/rjain/Store/signin.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log Out</title>
	<link rel="stylesheet" type="text/css" href="StoreStyles.css" media="all">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="StoreScript.js"></script>
</head>
<body>
 <header>
 	
 </header>
	<?php
?>
</body>
</html>