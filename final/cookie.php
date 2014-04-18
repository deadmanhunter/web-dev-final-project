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
		
		$db->query = "SELECT usern, passw, name, admin FROM TABLE_NAME WHERE usern='$user' AND passw='$pass'";
		$result = $db->sql_query($db->query);
		$row = $db->fetch_object($result);
		
		if ($user == $row->usern && $pass == $row->passw && $row->admin == 1) {
		
			if ($row) {
				
				$md = md5(rand(100, 10000));
				
				$db->query = "UPDATE TABLE_NAME SET adsess='$md' WHERE usern = '$row->usern' AND passw = '$row->passw'";
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
			
			$db->query = "SELECT usern, adsess, admin FROM TABLE_NAME WHERE usern = '$user'";
			$result = $db->sql_query($db->query);
			$row = $db->fetch_object($result);

			if ($row->adsess != 0 && $row->usern == $user && $row->admin == 1) {

				$db->query = "UPDATE TABLE_NAME SET adsess='0' WHERE usern = '$user'";
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

?>
