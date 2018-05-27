<?php
session_start();
if(!isset($_SESSION['id'])|| empty($_SESSION['id']))
    header("location:login.php");

$_SESSION['title'] = "Vote";
$_SESSION['loc_name'] ="Cast Your Votes";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
include('admin/Database.php')
?>
<div id="content" class="">				
		<div class="container">
             <div class="grid grid_24 prepend_1">
             <?php
             $db  = new Database();
            $prev = $curr=$pr=$cu="";
            $voter_id = isset($_SESSION['id'])?$_SESSION['id']:"";
            
          
            
             if(isset($_POST['submit']))
                {
                    if($db->isConnected())
                        {
                                $eid = $db->getData("select id from elections where status = 'started'");
                            if($db->infoExists("select election_id from ballotbox where voter_id = \"$voter_id\" and election_id=\"$eid\""))
                                {
                                      echo "<i style=\"color:red; font-size:16px; \">Voter has already voted!</i>";
                                }
                            else
                                {
                                    $query = "select categories.id,elections.id from categories,elections where elections.status='started'";
                                    
                                    $result = mysql_query($query);
                                    $val="";
                                    if($result)
                                        {$resp = false;
                                            while($row=mysql_fetch_row($result))
                                                { $pr = $val;
                                                   $val  = isset($_POST["$row[0]"])?$_POST["$row[0]"]:"";
                                                  
                                                    
                                                     if($pr==$val)  { $val=""; }
                                                     
                                                     if($val!="" && $voter_id!="")
                                                        {
                                                          $resp =   $db->updateDB("insert into ballotbox(election_id,voter_id,candidate_id)
                                                            values(\"$row[1]\",\"$voter_id\",\"$val\") ");
                                                            
                                                           
                                                        }
                                                }
                                                 if($resp)
                                                            {
                                                                echo "<i style=\"color:blue; font-size:16px; \">Vote Submited!</i>";
                                                                 header("location:logout.php");
                                                            }
                                                 else
                                                 echo "<i style=\"color:red;font-size:16px; \">Vote not Submited! <br>You have to vote for at least a Candidate</i>";
                                        }
                                }
                        }
                }
            
             
             ?>
             
             <div class="section_header">
					<h3>Candidates</h3>					
            </div>
            <form action="vote.php" method="post" class="form" >
                <fieldset title="Thread 1" id="custom-step-0" class="step" style="display: block; ">
            <?php
            
            if($db->isConnected())
                {
                    $eid = $db->getData("select id from elections where status='started'");
                    
                    $query = "select id,fname,lname,matno,pix_address,category_id,statement from candidates where election_id='$eid' order by category_id";
                    
                    $result = mysql_query($query);
                    
                    if($result)
                        {
                         if(mysql_num_rows($result)>0)
                         {
                           
                            echo "<table class=\"data display\">";
                            while($row = mysql_fetch_row($result))
                            { 
                                
                                $cat = $db->getData("select name from categories  where id=\"$row[5]\" ");
                                if(!empty($cat))
                                {
                                $curr = $row[5];
                                $row[6] = $row[6]==""?"None":$row[6];
                               if($prev!=$curr)
                                    {
                                        
                                ?>
                                  </tr>
                                <tr><td><font size='4' color='green'><b><?php echo $cat?></b></font></td></tr>
                                   <tr>
                                   <td width='180'><img src="admin/<?php echo $row[4]; ?>" alt="Candidate's Pix"  height='150'/><br/>
                                    <i style="font-size: 14px; color: black"> Names : <?php echo "$row[1], $row[0]"; ?> <br/>
                                     Post : <?php echo "$cat";?> <br/>
                                     Statement : <?php echo "$row[6]"; ?><br/>
                                     Vote <input type='radio' name="<?php echo $row[5]; ?>" value="<?php echo $row[0]; ?>"/>
                                     </i>
                                    </td>
                            
                            <?php
                                    $prev = $curr;
                                    }
                                    else
                                    {?>
                                    <td width='180'><img src="admin/<?php echo $row[4]; ?>" alt="Candidate's Pix"  height='150'/><br/>
                                    <i style="font-size: 14px; color: black"> Names : <?php echo "$row[1], $row[0]"; ?> <br/>
                                     Post : <?php echo "$cat";?> <br/>
                                     Statement : <?php echo "$row[6]"; ?><br/>
                                     Vote <input type='radio' name="<?php echo $row[5]; ?>" value="<?php echo $row[0]; ?>"/>
                                     </i>
                                     </td>
                                     <?php   
                                    }
                                }
                            }
                            echo " </table>";
                         }
                         else
                          echo "<i style=\"color:red; \">No candidate registered! or Election not Started!</i>";
                            
                        }
                }
            ?>
            
            <br />
        
                   <p align="center"> <button type="submit" name="submit" class="btn primary" style="width:200px; height:70px; font-size:20px;">Submit Vote</button></p>
	               
            </fieldset>
            </form>
            	
             
             
             </div>
        </div>
</div>
<?php
include('footer.php');
?>