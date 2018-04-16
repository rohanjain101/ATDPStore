<?php
	session_start();
	for($i = 0; $i< count($_SESSION["quantity"]);$i++)
	{
		$cartAmount+=$_SESSION["quantity"][$i];
	}
	
	echo "<div id=\"title\">";
echo "<a href=\"http://atdplogs.berkeley.edu/rjain/Store/store.php\"><img src=\"https://pbs.twimg.com/profile_images/1588607069/atdp-square-avatar_400x400.png\" with=\"100\" height=\"75\"></a>";
	echo "<span id=\"header\">ATDP Store</span>";
	if($_SESSION["loggedIn"])
	{
		
			echo "<span class=\"style\"><a href=\"http://atdplogs.berkeley.edu/rjain/Store/orderHistory.php\">Past Orders</a></span>";
		
		
		echo "<span class=\"style\"><a href=\"signout.php\">Log Out</a></span>";
	}

	if($_SESSION["isAdmin"] == 1)
	{
			echo "<span class=\"style\"><a href=\"newproduct.php\">New Product</a></span>";
			echo "<span class=\"style\"><a href=\"statistics.php\">Best Selling Product</a></span>";
			
	}

	echo "<span class=\"style\"><a href=\"store.php\"><img src=\"Images/home1.jpg\" id=\"homePic\"></a></span>";  //https://www.google.com/imgres?imgurl=http%3A%2F%2Fwww.iconarchive.com%2Fdownload%2Fi89703%2Falecive%2Fflatwoken%2FApps-Home.ico&imgrefurl=http%3A%2F%2Fwww.iconarchive.com%2Ftag%2Fhome-app&docid=CoKpWloYiqxybM&tbnid=d7iHkPfkLhgo1M%3A&w=256&h=256&bih=695&biw=1536&ved=0ahUKEwi-wbSQzo3OAhUB7WMKHbDxDUcQMwhrKBIwEg&iact=mrc&uact=8
	if($_SESSION["isAdmin"] == 0)
	{
		echo "<span class=\"style\"><a href=\"signin.php\">Sign In</a></span>";
		echo "<span class=\"style\"><a href=\"signup.php\">Sign Up</a></span>";
	}


		echo "<input type=\"text\" name=\"cartAmount\" value=\"{$cartAmount}\" id=\"amount\" readonly>";
		echo "<a href=\"cart.php\"><img src=\"Images/cart.png\" id=\"cartPic\" class=\"style\"></a>";	
	
		echo "<br>";
			if($_SESSION["loggedIn"])
			{
				$customerName = $_SESSION["customerName"];

				echo "<span class=\"style\">Welcome {$customerName}!</span>";
			}
	
	echo "</div>";
?>
<!-- 	<div id="title">
	<a href="http://atdplogs.berkeley.edu/rjain/Store/store.php"><img src="https://pbs.twimg.com/profile_images/1588607069/atdp-square-avatar_400x400.png" width="100" height="75"></a>
	<span id="header">ATDP Store</span>
	<span class="style"><a href="signout.php">Log Out</a></span>
	<span class="style"><a href="adminLogin.php">Admin Login</a></span>
	<span class="style"><a href="signin.php">Sign in</a></span>
	<span class="style"><a href="signup.php">Sign up</a></span>
		<input type="text" name="cartAmount" value="0" id="amount" readonly>
	<a href="cart.php"><img  src="Images/cart.png" id="cartPic" class="style"></a> -->

	