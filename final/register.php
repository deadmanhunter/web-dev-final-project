<!DOCTYPE html>
<html>
<head>
	<title>Grandmaster Sasies Gamiverse</title>
	<link rel="stylesheet" href="css.css"> 


</head>



<body class="body">

	<h1>Welcome to the Gamiverse</h1>

	<div class="menu" align="center">
		<ul class="navi">
			<li class="list"><a class="linked" href="index.html">Home</a></li>
			<li class="list"><a class="linked" href="new.html">New Releases</a></li>
			<li class="list"><a class="linked" href="upcoming.html">Upcoming Releases</a></li>
			<li class="list"><a class="linked" href="locate.html">Find a Store</a></li>
			<li class="list"><a class="linked" href="search.php">Search</a></li>
			<li class="list"><a class="linked" href="db.php">Recent Searches</a></li>
		</ul>
	</div>








	<div id="login" align="center">

		<?php

    if (!isset($_SESSION['usern']) && !isset($_SESSION['sess'])) { // Checks to see if the cookie is set for a logged in member, if not show the form to login

    	?>

    	<table border="0" cellspacing="0" cellpadding="0">
    		<form name="login" method="POST" action="register2.php">

    			<tr>
    				<td>Username: <INPUT type="text" id="user" class="user" name="usern" size="20"></td>
    				<td>Password: <INPUT type="password" id="pass" class="pass" name="passw" size="20"></td>
    				<td><INPUT type="submit" name="submit" value="Login"></td>
    			</tr>

    		</form>
    	</table>

    	<?php

    }
    else {

    	header("Location: register2.php");

    }
    
    ?>
    <p class="clear" />
</div>


<div align="center">
	<p style="text-align:center">Developed by Adam Sasi, powered by:</p>
	<a href="http://www.giantbomb.com" target="_blank"><img src="giantbomb.png", width="10%"></a>
</div>



</body>