<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Register Category";
$_SESSION['loc_name'] = "Category";
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
                $error = $name_error = true;
                $category_name="";
  
                if(isset($_POST['submit']))
                    { 
                        $category_name = $_POST['category'];
                        $election = $_POST['election'];
                        
                        if(empty($election) || empty($category_name))
                            {
                                 echo "<i style=\"color: red\"> Election or Category Name not given! </i>";
                            }
                         else
                            {
                                if($db->isConnected())
                                    {
                                        if(!$db->infoExists("select id from categories where name = \"$category_name\""))
                                            {
                                                $query = "insert into categories(name,election_id) 
                                                values(\"$category_name\",\"$election\")";
                                                
                                                $result =  $db->updateDB($query);
                                               
                                               if($result)
                                                {echo "<i style=\"color:blue; \"> Category Registered!</i>";
                                                    $category_name ="";
                                                }
                                                else
                                                 echo "<i style=\"color:red; \"> Category not Registered! <br/> Database Issue</i>";
                                            }
                                        else
                                            echo "<i style=\"color: red\"> Category already registered! </i>";
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
				<form action="register_category.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
		
	
					<div class="field input">
					
						<label>Category Name: <span class="required">*</span></label>
						
						<div class="fields">					
							<input type="text" name="category" value="<?php echo $category_name; ?>" id="category" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
					
					<div class="field select">
						
						<label>Election<span class="required">*</span></label>
						
						<div class="fields">
							<select name="election" id="election">
								<option value="">Select an Election...</option>
                                <?php
                                $query = "SELECT id,name from elections";  
                                
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