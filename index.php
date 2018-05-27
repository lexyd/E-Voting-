<?php
session_start();
if(!isset($_SESSION['id'])|| empty($_SESSION['id']))
    header("location:login.php");
    
$_SESSION['title'] = "Home";
$_SESSION['loc_name'] ="Home";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
include('admin/Database.php')
?>

<div id="content" class="">				
		<div class="container">
             <div class="grid grid_15 prepend_2">
             <?php
             $db = new Database();
             $eid=$ename=$info=$pix_loc="";
             $time =Date("l F d, Y");
             if($db->isConnected())
                {
                    if($db->infoExists("select id from elections where status='started'"))
                        {
                            $query = "select id,name,info,logo_address from elections where status='started'";
                            $result = mysql_query($query);
                            
                            if($result)
                                {
                                    if(mysql_num_rows($result)==1)
                                        {
                                            while($row = mysql_fetch_row($result))
                                                {
                                                    $eid = $row[0];
                                                    $ename = $row[1];
                                                    $info= $row[2];
                                                    $pix_loc = $row[3];
                                                }
                                        }
                                }
                            
                            ?>
                            <div class="blank_start" style="height:170px; width: 500px; ;">
                            <img alt="" width="160" height="170" src="admin/<?php echo $pix_loc; ?>" style="float: left; padding-right: 20px;"/>
				            <h1 align="left" style="font-size: 30px;">				    
				            <br/><?php echo $ename; ?>                 
				            </h1>
                            <h4 align="left"><?php echo $info; ?> </h4>
                           <h4 align="left"> <?php echo $time; ?></h4>
                           <h3 align="left"><a href="vote.php" style="color: red; " >Click Here to Vote!!!</a></h3>
				            </div>
                            <?php
                            
                        }
                    else
                        {
                               echo "<i style=\"color:red; \">No Ongoing Election</i>";
                        }
                }
             ?>
             
             
             </div>
        </div>
</div>

<?php
include('footer.php');
?>