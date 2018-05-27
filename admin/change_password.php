<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Change Password";
$_SESSION['loc_name'] = "User";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
include('Database.php');
?>
<div id="content" class="">		
        		
		<div class="container">
            <div class="grid grid_15 prepend_4">
            <?php
             $db = new Database();
  
                $old_ps =  $new_ps =$username ="";
                if(isset($_POST['submit']))
                    { 
                        $old_ps = $_POST['old_ps'];
                        $new_ps = $_POST['new_ps'];
                        $username = $_POST['username'];
                        
                        if(empty($old_ps) || empty($new_ps) || empty($username))
                            {
                                 echo "<i style=\"color: red\">At least ONE field is empty! </i>";
                            }
                         else
                            {
                                if($db->isConnected())
                                    {
                                        if($db->infoExists("select id from users where username = \"$username\" and password=\"$old_ps\""))
                                            {
                                                $uid = $db->getData("select id from users where username = \"$username\" and password=\"$old_ps\"");
                                                $query = "update users set password=\"$new_ps\" where id = \"$uid\"";
                                                
                                                $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {echo "<i style=\"color:blue; \">Password changed!</i>";
                                                    $old_ps =  $new_ps =$username ="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Password not changed! <br/> Database Issue</i>";
                                            }
                                        else
                                            echo "<i style=\"color: red\"> User does not exist! </i>";
                                    }
                                else
                                    echo "<i style=\"color: red\"> Database not available </i>";
                            }
                                   
                    }
              ?>
            <div class="section_header">
					<h3>Change Password</h3>					
				</div>
                
                <div class="grid grid_24">
				<form action="change_password.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
		
	
					<div class="field input">
					
						<label>Current Username <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="username" value="<?php echo $username; ?>" id="username" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
                    
                    <div class="field input">
					
						<label>Current Password <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="password" name="old_ps" value="<?php echo $old_ps; ?>" id="old_ps" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
				
                    <div class="field input">
					
						<label>New Password <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="password" name="new_ps" value="<?php echo $new_ps; ?>" id="new_ps" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
						
				
                    <div class="actions">
						<button type="submit" name="submit" class="btn primary">Change</button>
					</div> <!-- .actions -->		
                    </fieldset>
				</form>
            </div>
            
            </div>
        </div>
</div>

<?php
include('footer.php');
?>