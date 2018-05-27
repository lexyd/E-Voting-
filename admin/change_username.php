<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Change Username";
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
             $old_un=$new_un=$password="";
  
                if(isset($_POST['submit']))
                    { 
                        $old_un = $_POST['old_un'];
                        $new_un = $_POST['new_un'];
                        $password = $_POST['password'];
                        
                        if(empty($old_un) || empty($new_un) || empty($password))
                            {
                                 echo "<i style=\"color: red\">At least ONE field is empty! </i>";
                            }
                         else
                            {
                                if($db->isConnected())
                                    {
                                        if($db->infoExists("select id from users where username = \"$old_un\" and password=\"$password\""))
                                            {
                                                $uid = $db->getData("select id from users where username = \"$old_un\" and password=\"$password\"");
                                                $query = "update users set username=\"$new_un\" where id = \"$uid\"";
                                                
                                                $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {echo "<i style=\"color:blue; \">Username changed!</i>";
                                                    $old_un=$new_un=$password="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Username not changed! <br/> Database Issue</i>";
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
					<h3>Change Username</h3>					
				</div>
                
                <div class="grid grid_24">
				<form action="change_username.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
		
	
					<div class="field input">
					
						<label>Current Username <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="old_un" value="<?php echo $old_un; ?>" id="old_un" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
                    
                    <div class="field input">
					
						<label>Current Password <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="password" name="password" value="<?php echo $password; ?>" id="password" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
				
                    <div class="field input">
					
						<label>New Username <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="new_un" value="<?php echo $new_un; ?>" id="new_un" size="45" />
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