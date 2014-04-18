	<?php
	// Connect to MySQL // for iPage
		$gsearch = $_POST["searchstring"];
			if($gsearch != ""){

	    	require ('../finalconn.php');
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

		
			$sql="INSERT INTO searches (searched)
			VALUES
			('$gsearch')";
			
			if (!mysqli_query($con,$sql))
			  {
			  die('Error: ' . mysqli_error($con));
			  }
		

			mysqli_close($con);
		}

	?>