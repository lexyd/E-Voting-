<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Register Voter";
$_SESSION['loc_name'] = "Voter";
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
            $matno="";
                if(isset($_POST['submit']))
                    { 
                        $matno = $_POST['matno'];
                        
                        if(empty($matno))
                            {
                                 echo "<i style=\"color: red\">Matric Number not given!</i>";
                            }
                         else
                            {
                                if($db->isConnected())
                                    {
                                        if(!$db->infoExists("select id from voters where matno = \"$matno\""))
                                            {
                                                $query = "insert into voters(matno) 
                                                values(\"$matno\")";
                                                
                                                $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {
                                                    echo "<i style=\"color:blue; \"> Voter Registered!</i>";
                                                    $matno ="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Voter not Registered! <br/> Database Issue</i>";
                                            }
                                        else
                                            echo "<i style=\"color: red\"> Voter already registered! </i>";
                                    }
                                else
                                    echo "<i style=\"color: red\"> Database not available </i>";
                            }
                                   
                    }
              ?>
            <div class="section_header">
					<h3>Register a Category</h3>					
				</div>
                
                <div class="grid grid_24">
				<form action="register_voter.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
		
	
					<div class="field input">
					
						<label>Category Name: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="matno" value="<?php echo $matno; ?>" id="matno" size="45" />
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
</div>

<?php
include('footer.php');
?>