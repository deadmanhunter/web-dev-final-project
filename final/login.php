<?php

class Login {
	
	public function check_login($chkuser, $chkpass) {
			
			if (isset($chkuser) && isset($chkpass)) {
					
				global $db;
		  
				$pw = md5($chkpass);
				
				$db->query = "SELECT usern, passw, admin, adsess FROM TABLE_NAME WHERE usern='$chkuser' AND passw='$pw'";					
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
