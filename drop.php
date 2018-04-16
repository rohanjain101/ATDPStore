<!DOCTYPE html>
<html>
<head>
	<title>Drops</title>
</head>
<body>
<?php
	require_once "rohanConfig.php";
	try {
	    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	    //create comic table
	    $query = file_get_contents('drop.sql');
	    $dbh->exec($query);

    echo "<p>Successfully dropped databases</p>";
	}
	catch (PDOException $e) {
	    echo "<p>Error: {$e->getMessage()}</p>";
	}
?>
</body>
</html>