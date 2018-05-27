<?php
session_start();
/**
 * @author franco
 * @copyright 2013
 */
?>
<!DOCTYPE html>
 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<title>Login</title> 
	
	<link rel="stylesheet" href="admin/css/reset.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="admin/css/text.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="admin/css/buttons.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="admin/css/login.css" type="text/css" media="screen" title="no title" />
    <link rel="stylesheet" href="admin/css/all.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="admin/themes_/.html" type="text/css" media="screen" title="no title" id="theme" />

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
	<h1>Voters Login</h1>
	<div id="login_panel">
            
		<form action="login.php" method="post" accept-charset="utf-8">		
			<div class="login_fields">
            <?php
            include('admin/Database.php');
            $matno = "";
             $db = new Database();
                if(isset($_POST['submit']))
                    {
                        $matno = $_POST['matno'];
                        
                        if(!$db->infoExists("select id from elections where status='started'"))
                            {
                               ?>
                               <i style="color: red;">No ongoing Election!<br /> Please check back at a later time..</i> 
                               <?php 
                            }
                     
                       else if(empty($matno))
                            {?>
                               <i style="color: red;">Error in Form: No Matric Number entered!</i> 
                               <?php
                            }
                        else
                            {
                                
                                if($db->isConnected())
                                    {
                                        if($db->infoExists("select id from voters where matno=\"$matno\" "))
                                            {
                                                
                                                $id = $db->getData("select id from voters where matno=\"$matno\"");
                                                
                                                if($db->infoExists("select election_id from ballotbox where voter_id=\"$id\" "))
                                                    {
                                                         echo "<i style=\"color: red;\">Voter has already voted!</i> ";
                                                    }
                                                else
                                                    {
                                                        $_SESSION['id'] = $id;
                                                         header("location:index.php");
                                                    }
                                                
                                            }
                                        else
                                         echo "<i style=\"color: red;\">Matric Number is invalid!</i> ";
                                    }
                            }
                    }
            ?>
				<div class="field">
					<label for="matno">Matric Number</label>
					<input type="text" name="matno" value="<?php echo $matno ?>" id="matno" tabindex="1" placeholder="e.g 2007/0400" />		
				</div>
				
				
			</div> <!-- .login_fields -->
			
			<div class="login_actions" >
				<p align="right" style="color: green;"><button type="submit" class="btn primary" tabindex="2" name="submit">Login</button>
                </br> &copy; Powered by Nacoss Bellstech Chapter</p>
                </div>
		
		</form>
	</div> <!-- #login_panel -->		
    <p>&nbsp; &nbsp;  <a>Development Team</a></p>
     
    
</div> <!-- #login -->


</div> <!-- #wrapper -->

</body> 
 
</html>
