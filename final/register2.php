<!DOCTYPE html>
<html>
<head>
	<title>Grandmaster Sasies Gamiverse</title>
	<link rel="stylesheet" href="css.css"> 


<?php 

session_start();
$db = new Database();
$cookie = new Cookie();
$login = new Login();

login(); // Simple right?

function login() {

	if ($_POST['submit'] == "Login") {
	  
		$usern = $_POST['usern'];
		$passw = $_POST['passw'];
		  
		unset($_POST['submit']);
		unset($_POST['usern']);
		unset($_POST['passw']);
		  
		global $login;
		  
		$login->check_login($usern, $passw);
	
	}

	// Logout
    
	if (isset($_GET['action']) && isset($_SESSION['user']) && isset($_SESSION['sess'])) {
		
		if ($_GET['action'] === "logout") {
			
			unset($_GET['action']);
		
			global $login;
			
			$login->logout();
					
		}
		
	}

}

?>


<?php

class Login {
	
	public function check_login($chkuser, $chkpass) {
			
			if (isset($chkuser) && isset($chkpass)) {
					
				global $db;
		  
				$pw = md5($chkpass);
				
				$db->query = "SELECT usern, passw, admin, adsess FROM login WHERE usern='$chkuser' AND passw='$pw'";					
				$result = $db->sql_query($db->query);
				$row = $db->fetch_object($result);
				
				if ($chkuser == $row->usern && $pw == $row->passw) {
				  
				  global $cookie;
			
				  $cookie->login_cookie($row->usern, $row->passw);
	
				  if ($row->admin === '1') {
	
					  $cookie->admin_cookie($row->usern, $row->passw);
					  
				  }
				  
				  
				  
				  if (isset($_SESSION['admin']) && isset($_SESSION['adchk'])) {

						 header("Location: http://www.YOURSITE.com"); // This will redirect the ADMIN to the homepage of the admin section
				  
				  }
				  else {
					
						header("Location: index.php");  // Change this to your homepage
				 
				  }
				  
				}
				else {
				
				?>
                
                	<script type="text/javascript">
                    
                    	alert('The Username and/or Password did not match. Please try again.');
                    
                    </script>
                
                <?php
				
					header("Location: index.php");
					
				}
				
			}
				
			else {
			
				?>
                
                	<script type="text/javascript">
                    
                    	alert('The Username and/or Password did not match. Please try again.');
                    
                    </script>
                
                <?php
				
			}
					
	}
	
	function logout() {
		
		global $cookie;
		
		foreach ($_SESSION as $key => $value) {
			
			$cookie->kill_cookie($key, $value);
			
		}
		
		unset($_SESSION[PHPSESSID]);
		
		header("Location: index.php");
		
	}
		  	
} // end class

?>

<?php

class Cookie {
	
	function login_cookie($username, $password) {
		
		if (isset($username) && isset($password)) {
			
			$rand = md5(rand(10000, 99999999));
			
                        $_SESSION[$usern] = $username;
                        $_SESSION[$user] = md5($username);
                        $_SESSION[$sess] = $rand;

		}
		else {
		?>	
			<script type="text/javascript">
                    
                alert('The Username and/or Password did not match. Please try again.');
                    
           </script>
           
         <?php  
		}
		
	}
	
	function admin_cookie($user, $pass) {
		
		global $db; // My database connection...add yours here
		
		$db->query = "SELECT usern, passw, name, admin FROM login WHERE usern='$user' AND passw='$pass'";
		$result = $db->sql_query($db->query);
		$row = $db->fetch_object($result);
		
		if ($user == $row->usern && $pass == $row->passw && $row->admin == 1) {
		
			if ($row) {
				
				$md = md5(rand(100, 10000));
				
				$db->query = "UPDATE login SET adsess='$md' WHERE usern = '$row->usern' AND passw = '$row->passw'";
				$result = $db->sql_query($db->query);
				
				if ($result) {
					
					$name = $row->name;
					$mdname = md5($name);
					
					$_SESSION['admin'] = md5($mdname);
					$_SESSION['adchk'] = md5($mdname . $mdname);
	
				}
				else {
					
					?>	
						<script type="text/javascript">
                                
                            alert('The Admin Privileges were not set.');
                                
                       </script>
           
        		 <?php  
					
				}
				
			} 
			else {
				
				?>	
					<script type="text/javascript">
                            
                        alert('The Username and Password could not be checked against the database.');
                            
                   </script>
               
             <?php  
				
			}
			
		}
		else {
			
			?>	
				<script type="text/javascript">
                        
                    alert('The Username and/or Password did not match (Admin).');
                        
               </script>
           
         <?php  
			
		}
		
	}
	
	function kill_cookie($name = "", $value = "") {
		
		if (isset($name)) {
			
			global $db;
			
			$user = $_SESSION['usern'];
			
			$db->query = "SELECT usern, adsess, admin FROM login WHERE usern = '$user'";
			$result = $db->sql_query($db->query);
			$row = $db->fetch_object($result);

			if ($row->adsess != 0 && $row->usern == $user && $row->admin == 1) {

				$db->query = "UPDATE login SET adsess='0' WHERE usern = '$user'";
				$db->sql_query($db->query);
			
			}
			
			session_destroy($_SESSION);
			
		}
		else {
			
			?>	
			<script type="text/javascript">
                    
                alert('The cookies were not deleted.');
                    
           </script>
           
         <?php  
			
		}
		
	}
	
}

class Database {
	
	protected $db;
	protected $num;
	public $result;
	var $query;
	
	function __construct() {
		
		global $host, $user, $pass, $name;
		
		$this->dbhost = $host;
		$this->dbuser = $user;
		$this->dbpass = $pass;
		$this->dbname = $name;
		$this->db_open();
	}
	
	protected function db_open() {
		
		$this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		
		if (empty($this->db)) {
			
			error('DATABASE CONNECTION FAILED.', MYSQL_ERROR);
			
		}
		else {
			
			return $this->db;
			
		}
		
	}
	
	public function sql_query($query) {
		
		if (isset($query)) {
		
				$result = mysqli_query($this->db, $query) or die("Error: ".mysqli_error($this->db));
		
				if (!isset($result)) {

					die("Query connection failed: " . mysqli_error($this->db)); // Change this to whatever you want
			
				}
				else {
						
					return $result;
				
				}
				
		}
		else {
					
			// Your error message here: "Query was empty".
			
		}
		
	}
	
	public function fetch_object($obj) {
		
		return mysqli_fetch_object($obj);
		
	}
	
	public function num_rows($num) {
		
		return mysqli_num_rows($num);
		
	}
	
	function db_close($db) {
		
		if (isset($db)) {
			
			mysqli_close($db);
			unset($db);
			
		}
		
	}
	
} // end db class

?>



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




	<div align="center">

		<?php
    
	    	if (!isset($_SESSION['usr']) && !isset($_SESSION['sess'])) { // Checks to see if the cookie is set for a logged in member, if not show the form to login
		
	    ?>
		<form id="login" action="register2.php" method="post">
			<table align="center">
				<tr>
					<td><label for="usr">Username:</label></td>
					<td><input type="text" id="usr" value="usr"></label></td>

				</tr>
				
				<tr>
					<td><label for="pass">Password:</label></td>
					<td><input type="text" id="pass" value="pass"></label></td>
				</tr>
				<tr></tr>
				<tr><INPUT type="submit" name="submit" value="Login"></tr>
			</table>

		</form>

			<?php
    
		    }
		    else {
		    
		    	header("Location: register.php");
		    
		    }
		    
		    ?>
		    <p class="clear" />

	</div>



	<div align="center">
		<p style="text-align:center">Developed by Adam Sasi, powered by:</p>
		<a href="http://www.giantbomb.com" target="_blank"><img src="giantbomb.png", width="10%"></a>
	</div>



</body>