<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Register Election";
$_SESSION['loc_name'] = "Elections";
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
                $error = $name_error = true;
                $election_name = $info="";
  
                if(isset($_POST['submit']))
                    { 
                        $election_name = $_POST['election'];
                                    $info = $_POST['info'];
              
                         //Validating the uploaded picture
                    if ((($_FILES["logo"]["type"] == "image/gif")
                            || ($_FILES["logo"]["type"] == "image/jpeg")
                            || ($_FILES["logo"]["type"] == "image/pjpeg"))
                            && ($_FILES["logo"]["size"] < 300000))               //In kilobytes
                            { 
                                if ($_FILES["logo"]["error"] > 0)
                                    { 
                                       echo "<i style=\"color: red\">" . $_FILES["logo"]["error"] . "</i>";
                                       $error = true;
                                    }
                                   else
                                    {
                                        if (file_exists("pics/elections/" . $_FILES["logo"]["name"]))
                                           {
                                              echo "<i style=\"color: red\">".$_FILES["logo"]["name"] . " already exists. </i>";
                                                $error = true;
                                           }
                                        else
                                          {
                                               $error = false;
                                          }
                                    }
                                    
                            }
                            else
                            { 
                                if($_FILES["logo"]["name"]!="")
                                 {
                                     echo "<i style=\"color: red\"> Issues with Logo Upload,<br/> Please make sure the image is a jpg file and less than 300kb in size</i>";
                                         $error = true;
                                    
                                 }
                                 else
                                 {
                                     echo "<i style=\"color: red\"> Logo not Uploaded,<br/> Please make sure the image is a jpg file and less than 300kb in size</i>";
                                         $error = true;     
                                 }
                            }
                            
                            if(!$error)
                                {
                                 $name_error = empty($election_name)?true:false;
                                 
                                 if(!$name_error)
                                    {
                                         move_uploaded_file($_FILES["logo"]["tmp_name"],"pics/elections/" . $_FILES["logo"]["name"]);
                                           //echo "Stored in: " . "images/" . $_FILES["pixupload"]["name"];
                                         $pixloc = "pics/elections/" . $_FILES["logo"]["name"]; 
                                         
                                         $query = "insert into elections(name,info,logo_address,status) 
                                         values(\"$election_name\",\"$info\",\"$pixloc\",\"registered\")";
                                          $db = new Database();
                                          
                                          if($db->isConnected())
                                            {
                                                
                                             if(!$db->infoExists("select id from elections where name = \"$election_name\""))
                                             {
                                               $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {echo "<i style=\"color:blue; \"> Election Registered!</i>";
                                                    $election_name =$info="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Election not Registered! <br/> Database Issue</i>";
                                             }
                                             else
                                                echo "<i style=\"color:red; \"> Election already Registered!</i>";
                                            }
                                         
                                    }
                                    else
                                    {
                                         echo "<i style=\"color:red; \"> Election Name not given!</i>";
                                    }
                                }
                    }
                ?>
            
				<div class="section_header">
					<h3>Register an Election</h3>					
				</div>
                
                <div class="grid grid_24">
				<form action="register_election.php" method="post" class="form" enctype="multipart/form-data">
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
					
                <div class="field file">
						
						<label>Upload Association Logo : <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="file" name="logo" id="logo" />
						</div> <!-- .fields -->
						
				</div> <!-- .field -->
	
					<div class="field input">
					
						<label>Election Name: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="election" value="<?php echo $election_name; ?>" id="election" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
					
					<div class="field input">
						
						<label>Small info</label>
						
						<div class="fields">					
						<!--<div class="error"><span>This field is required</span></div>-->
											
							<textarea name="info" rows="8" cols="45"><?php echo $info; ?></textarea>
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
				
                <div class="actions">
						<button type="submit" name="submit" class="btn primary">Submit</button>
					</div> <!-- .actions -->		
                    </fieldset>
				</form>
            </div>
            
        </div>
        
</div>


<?php
include('footer.php');
?>