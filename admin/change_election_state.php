<?php
session_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
    
$_SESSION['title'] = "Start/End Election";
$_SESSION['loc_name'] = "Election";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
include('Database.php');
include('Util.php');
$db = new Database();
$ut = new Util();
$opr= "";
$time = date('Y-m-d H:i:s', time());
?>
<div id="content" class="">		
        		
		<div class="container">
            <div class="grid grid_15 prepend_4">
            <?php
            if(isset($_REQUEST['eid']) && !empty($_REQUEST['eid']) 
            && isset($_REQUEST['opr']) && !empty($_REQUEST['opr']))
                {
                    $eid = $_REQUEST['eid'];
                    $opr = $_REQUEST['opr'];
                    
                   
                    
                    if($db->isConnected())
                        {   
                            
                            if($opr=="start")
                            {
                              if($db->infoExists("select id from elections where status='started'"))
                                {
                                     echo "<i style=\"color: red\"> Cannot start the Election,<br/> An election has already been started!  </i>";
                                }
                              else
                                {
                                    $query = "update elections set status ='started', start_date=\"$time\" where id = '$eid' ";
                                    $result =   $db->updateDB($query);
                                    if($result)
                                        echo "<i style=\"color: blue\"> Election is now in progress!  </i>";
                                    else
                                        echo "<i style=\"color: red\"> Cannot start the Election,<br/> Database issue!  </i>";
                                }
                            }
                            else
                                {
                                     $query = "update elections set status ='ended', end_date=\"$time\" where id = '$eid' ";
                                    $result =   $db->updateDB($query);
                                    if($result)
                                        echo "<i style=\"color: blue\"> Election is now Ended!  </i>";
                                    else
                                        echo "<i style=\"color: red\"> Cannot end the Election,<br/> Database issue!  </i>";
                                }
                        }
                }
            ?>
            <div class="section_header">
					<h3>Start/End Election</h3>					
				</div>
            <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
            <table class="data display">
					<thead>
						<tr>
							<th>Election Name</th>
							<th>Status</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
                    <tbody>
                        
                          <?php
                               
                                $query = "SELECT id,name,status from elections";  
                                
                                 if($db->isConnected())
                                    {
                                
                                   $result = mysql_query($query);  
                                  if($result) 
                                     {
                                  if(mysql_num_rows($result) > 0)
                                     {
                                   while($row = mysql_fetch_row($result))  
                                       {
                                     echo "<tr><td>$row[1]</td> <td>$row[2]</td>";
                                     $action = "Start Election";
                                     $opr = "start";
                                        if($row[2]=="started")
                                            {
                                                $action = "End Election";
                                                $opr= "end";
                                            }
                                        
                                         if($row[2]=="ended")
                                            {
                                               
                                                echo "<td> No Operation </td></tr>";
                                            }
                                         else
                                         {
                                     echo "<td> <a href=\"change_election_state.php?eid=$row[0]&&opr=$opr\">$action</a></td></tr>";
                                        }
                                       }
                          
                                     }   
                                     } 
                                        
                                    }
                                ?>		
                        
                    </tbody>
            </table>
            </fieldset>
            </div>
        </div>
</div>


<?php
include('footer.php');
?>