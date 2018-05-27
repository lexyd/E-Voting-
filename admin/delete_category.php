<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Delete Category";
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
                $error =  true;
                $cid ="";
                    
  
                if(isset($_POST['submit']))
                    { 
                        $cid = $_POST['category'];
                        
                        if($db->isConnected())
                            {
                                if($db->infoExists("select name from categories where id=\"$cid\""))
                                    {
                                       
                                        
                                                $query="delete from categories where id=\"$cid\"";
                                                $result = $db->updateDB($query);
                                                
                                                if($result)
                                                    {echo "<i style=\"color: blue\">Category deleted! </i>";
                                                    $eid ="";
                                                    }
                                                else
                                                    {
                                                        echo "<i style=\"color: red\"> Category not Deleted! </i>";
                                                    }
                                        
                                    }
                                else
                                echo "<i style=\"color: red\"> Category ID ivalid! </i>";
                            }
                    }
                ?>

                <div class="section_header">
					<h3>Delete a Category</h3>					
				</div>
                
                <div class="grid grid_24">
				<form action="delete_category.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
		
	
					<div class="field input">
					
						<label> Enter Category Id </label>
						
						<div class="fields">					
							<input type="text" name="category" value="<?php echo $cid; ?>" id="category" size="45" />
						</div> <!-- .fields -->
						
					</div> <!-- .field -->
					
				
						
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

