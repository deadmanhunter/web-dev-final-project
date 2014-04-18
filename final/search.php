<!DOCTYPE html>
<html>
<head>
	<title>Grandmaster Sasies Gamiverse</title>
	<link rel="stylesheet" href="css.css"></link>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script src="../js/api.js"></script>


</head>



<body class="body">

	<h1>Welcome to the Gamiverse</h1>

	<div class="menu">
			<ul class="navi">
				<li class="list"><a class="linked" href="index.html">Home</a></li>
				<li class="list"><a class="linked" href="new.html">New Releases</a></li>
				<li class="list"><a class="linked" href="upcoming.html">Upcoming Releases</a></li>
				<li class="list"><a class="linked" href="locate.html">Find a Store</a></li>
				<li class="list"><a class="linked" href="search.php">Search</a></li>
				<li class="list"><a class="linked" href="db.php">Recent Searches</a></li>
			</ul>
	</div>

	<div align="center">
		<form method="post" id="pform">
			<input type="text" id="gsearch" name="gsearch"></input>
			<input type="button" id="gbutton" onclick="gamesearch()" value="Search"></input>
		</form>
	</div>


	<div id="searchresults"></div>

	<div align="center">
		<p style="text-align:center">Developed by Adam Sasi, powered by:</p>
		<a href="http://www.giantbomb.com" target="_blank"><img src="giantbomb.png", width="10%"></a>
	</div>




</body>
