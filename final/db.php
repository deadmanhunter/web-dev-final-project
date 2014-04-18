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


	<?php
	// Connect to MySQL
	    require ('../finalconn.php'); // for iPage
	    //require ('../../../../mysqli_connect.php'); 




	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }


	$result = mysqli_query($con, "SELECT * FROM searches");

	echo "<table border='1' align='center' text-color='#f00'>
	<tr>
		<th>Others have searched for</th>
	</tr>";

	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $row['searched'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";


		mysqli_close($con);
	?>
	

	<div align="center">
		<p style="text-align:center">Developed by Adam Sasi, powered by:</p>
		<a href="http://www.giantbomb.com" target="_blank"><img src="giantbomb.png", width="10%"></a>
	</div>

</body>