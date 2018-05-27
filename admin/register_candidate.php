<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Register Candidate";
$_SESSION['loc_name'] = "Candidates";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
include('Database.php');
include('Util.php');
?>

<div id="content" class="">		
        		
		<div class="container">
            <div class="grid grid_15 prepend_4">
            <?php
            $db = new Database();
            $ut = new Util();
            $fname=$lname=$info=$matno="";
            $disable_button= false;
            $query = "select id from elections where status ='started'";
            $result = $db->infoExists($query);
            
            if($result)
                $disable_button= false;
            else
                $disable_button= true;
            
            
            if(isset($_POST['submit']))
                    { 
                      
                        $fname = $_POST['fname']; $fields[0] = $fname;
                        $lname = $_POST['lname']; $fields[1] = $lname;
                        $matno = $_POST['matno']; $fields[2] = $matno;
                        $gender = $_POST['gender']; $fields[3] = $gender;
                        $election = $_POST['election']; $fields[4] = $election;
                        $category =$_POST['category']; $fields[5] = $category;
                        $info = $_POST['info']; 
                        
                        $validated = false;
                        $n = $ut->emptyFields($fields);
                        
                        $validated = $n==0?true:false;
                        
                        
                        
                         if ((($_FILES["pix"]["type"] == "image/gif")
                            || ($_FILES["pix"]["type"] == "image/jpeg")
                            || ($_FILES["pix"]["type"] == "image/pjpeg"))
                            && ($_FILES["pix"]["size"] < 900000))               //In kilobytes
                            {
                                if ($_FILES["pix"]["error"] > 0)
                                    { 
                                       echo "<i style=\"color: red\">" . $_FILES["pix"]["error"] . "</i>";
                                       $error = true;
                                    }
                                   else
                                    {
                                        if (file_exists("pics/candidates/" . $_FILES["pix"]["name"]))
                                           {
                                              echo "<i style=\"color: red\">".$_FILES["pix"]["name"] . " already exists. </i>";
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
                                if($_FILES["pix"]["name"]!="")
                                 {
                                     echo "<i style=\"color: red\"> Issues with Pix Upload,<br/> Please make sure the image is a jpg file and less than 900kb in size</i>";
                                         $error = true;
                                    
                                 }
                                 else
                                 {
                                     echo "<i style=\"color: red\"> Picture not Uploaded,<br/> Please make sure the image is a jpg file and less than 900kb in size</i>";
                                         $error = true;     
                                 }
                                }
                                
                                if($validated && !$error)
                                    {
                                          $db = new Database();
                                          
                                          if($db->isConnected())
                                            {
                                                
                                             if(!$db->infoExists("select id from candidates where matno = \"$matno\""))
                                             {
                                                move_uploaded_file($_FILES["pix"]["tmp_name"],"pics/candidates/" . $_FILES["pix"]["name"]);
                                                   //echo "Stored in: " . "images/" . $_FILES["pixupload"]["name"];
                                                 $pixloc = "pics/candidates/" . $_FILES["pix"]["name"]; 
                                                 
                                                 $query = "insert into candidates(fname,lname,matno,gender,election_id,category_id,statement,pix_address) 
                                                 values(\"$fname\",\"$lname\",\"$matno\",\"$gender\",\"$election\",\"$category\",\"$info\",\"$pixloc\")";
                                                 
                                               $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {
                                                    echo "<i style=\"color:blue; \"> Candidate Registered!</i>";
                                                    $fname=$lname=$info=$matno="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Candidate not Registered! <br/> Database Issue</i>";
                                             }
                                             else
                                                echo "<i style=\"color:red; \"> Candidate already Registered!</i>";
                                            }
                                         
                                    }
                                    else
                                    {
                                         echo "<i style=\"color:red; \">".$n." Required field(s) not answered!</i>";
                                    }
                                
                                
                    }
            
            
            ?>
            
            
            <div class="section_header">
					<h3>Register a Candidate</h3>					
            </div>
            
            <div class="grid grid_24">
				<form action="register_candidate.php" method="post" class="form" enctype="multipart/form-data">
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
					
                <div class="field file">
						
						<label>Upload Candidate Picture : <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="file" name="pix" id="pix" />
						</div> <!-- .fields -->
						
				</div> <!-- .field -->
                
                <div class="field input">
					
						<label>Firstname: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="fname" value="<?php echo $fname; ?>" id="fname" size="30" />
						</div> <!-- .fields -->
						
				</div> <!-- .field -->
                
                 <div class="field input">
					
						<label>Lastname: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="lname" value="<?php echo $lname; ?>" id="lname" size="30" />
						</div> <!-- .fields -->
						
				</div> <!-- .field -->
                
                 <div class="field input">
					
						<label>Matric Number: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="matno" value="<?php echo $matno; ?>" id="matno" size="30" />
						</div> <!-- .fields -->
						
				</div> <!-- .field -->
                
                <div class="field select">
						
						<label>Gender: <span class="required">*</span></label>
                <div class="fields">
							<select name="gender" id="gender">
								<option value="male">Male</option>
                                <option value="female" selected="true">Female</option>
                            </select>
                </div>
                </div>
                
                <div class="field select">
						
						<label>Election: <span class="required">*</span></label>
                <div class="fields">
							<select name="election" id="election">
								
                                <?php
                                $eid = "";
                                $query = "SELECT id,name from elections where status='started'";  
                                
                                 if($db->isConnected())
                                    {
                                
                                   $result = mysql_query($query);  
                                  if($result) 
                                     {
                                  if(mysql_num_rows($result) > 0)
                                     {
                                   while($row = mysql_fetch_row($result))  
                                       {
                                     echo "<option value=\"$row[0]\"> $row[1] </option>";
                                        $eid = $row[0];
                                       }
                          
                                     }   
                                     } 
                                        
                                    }
                                ?>			
                            </select>
                </div>
                </div>
                
                <div class="field select">
						
				<label>Category:<span class="required">*</span></label>
                <div class="fields">
							<select name="category" id="category">
								<option value="">Select a Category...</option>
                                <?php
                               
                                $query = "SELECT id,name from categories where election_id=\"$eid\"";  
                                
                                 if($db->isConnected())
                                    {
                                
                                   $result = mysql_query($query);  
                                  if($result) 
                                     {
                                  if(mysql_num_rows($result) > 0)
                                     {
                                   while($row = mysql_fetch_row($result))  
                                       {
                                     echo "<option value=\"$row[0]\"> $row[1] </option>";
                                        
                                       }
                          
                                     }   
                                     } 
                                        
                                    }
                                ?>			
                            </select>
                </div>
                </div>
                
                <div class="field input">
						
						<label>Short Statement: </label>
						
						<div class="fields">					
						<!--<div class="error"><span>This field is required</span></div>-->
											
							<textarea name="info" rows="8" cols="30"><?php echo $info; ?></textarea>
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
                
                
                <div class="actions">
                <?php
                  //  if($disable_button)
                    //    echo "<button type=\"submit\" name=\"submit\" class=\"btn primary\">Submit</button>";
                   // else
                    //    echo "<button type=\"submit\" name=\"submit\" class=\"btn primary\" disabled=\"disabled\">Submit</button>";
                ?>
                    <button type="submit" name="submit" class="btn primary">Submit</button>
					
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