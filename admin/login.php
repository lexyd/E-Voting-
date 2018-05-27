<?php
session_start();
ob_start();
/**
 * @author franco
 * @copyright 2013
 */

?>
<!DOCTYPE html>
 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<title>Admin Login</title> 
	
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="css/text.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="css/buttons.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" title="no title" />
    <link rel="stylesheet" href="css/all.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="themes_/.html" type="text/css" media="screen" title="no title" id="theme" />


</head> 
 
<body style="background: black;"> 

<div id="wrapper" class="">
	
	<div id="header">		
		<div class="container">
			<div class="grid grid_24">
				
				<ul>							
					<li class="nav">						
						<h2 style="color: #FFF; ">Electronic Voting System</h2>					
					</li>	
					
		
				</ul>	
			</div> <!-- .grid -->
		</div> <!-- .container -->
	</div> <!-- #header -->


<div id="login">
	<h1>Admin Login</h1>
	<div id="login_panel">
		<form action="login.php" method="post" accept-charset="utf-8">		
			<div class="login_fields">
             <?php
             include('Database.php');
             $username="";
                if(isset($_POST['submit']))
                    {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        
                        if(empty($username)||empty($password))
                            {?>
                               <i style="color: red;">Error in Form: Username or Password not given!</i> 
                               <?php
                            }
                        else
                            {
                                $db = new Database();
                                if($db->isConnected())
                                    {
                                        
                                        if($db->infoExists("select id from users where username=\"$username\" and password=\"$password\""))
                                            {
                                               $id =  $db->getData("select id from users where username=\"$username\" and password=\"$password\"");
                                              
                                                $_SESSION['user_id']=$id;
                                                $_SESSION['ps']=$password;
                                                  header("location:register_election.php");
                                            }
                                        else
                                         echo "<i style=\"color: red;\">Username or Password is invalid!</i> ";
                                    }
                              
                            }
                    }
            ?>
				<div class="field">
					<label for="username">Username</label>
					<input type="text" name="username" value="<?php echo $username ?>" id="username" tabindex="1" placeholder="e.g John" />
                    <label for="password">Password</label>
					<input type="password" name="password" value="" id="password" tabindex="2" placeholder="e.g johnsnow" />		
				</div>
				
				
			</div> <!-- .login_fields -->
			
			<div class="login_actions" >
				<p align="right" style="color: green;"><button type="submit" class="btn primary" tabindex="3" name="submit">Login</button>
                </br> &copy; Powered by Nacoss Bellstech Chapter</p>
                </div>
		</form>
	</div> <!-- #login_panel -->
     <p>&nbsp; &nbsp;  <a>Development Team</a></p>		
</div> <!-- #login -->

</body> 
 
</html>
<?php ob_end_flush(); ?>