<?php 
session_start();
ob_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");

/**
 * @author franco
 * 
 */
function getElection($eid)
  {
  $query  = "select name,logo_address from elections where id='$eid' ";
    $result = mysql_query($query);

   if(!$result)
     {
      echo "<i style=\"colr:red\"> Cannot Query the database </br>"; $error = mysql_error();
       echo $error."</i>"; 
       return false;
     }
   else
        {
             if(mysql_num_rows($result) > 0)
        {
               while($row = mysql_fetch_row($result)) 
           {
              echo "<table width='700' align='center'>";
              echo "<tr><td width='160'><img src=\"$row[1]\" alt='Election Logo' width='130' height='130'></td>";
              echo " <td> <font size='5' > <h1 style=\"color:black\">$row[0] </h1></font>  </td> </tr>";
              echo "</table>";
           }       
        }
        else { /*echo"<i style=\"colr:red\">Election results not Found!</i>"; */return false;}
        }
  }
 ?>

<html>
<head>
 <?php 

  include('Database.php');  
  include('Util.php'); ?>
</head>

<body>

<p align='left'><a href='view_poll.php'>Back to Previous Page</a></p>
<fieldset style="border-style: ridge; border-radius:8px; position: absolute; left:3%; border-color: black; font-family: Tahoma; ">
<?php
//getting election id
  $eid =  isset($_REQUEST['eid'])?$_REQUEST['eid']:"";
  $db = new Database();
  $ut = new Util();

if($db->isConnected())
{   if(!empty($eid))
     {
        getElection($eid);
          echo " <p align='center'><font size='3'>Election Result is given below;</font></p><hr><br/>";
         ?>
         
         <table width='500' border='1' cellspacing='0' cellpadding='10' align='center' style="border-radius: 10px;">
         <tr>
            <th>S/N</th>
			<th>Candidates</th>
			<th>Post</th>
			<th>Number of Votes</th>
         </tr>
         <?php
         $i=1;
                $query = "select id,fname,lname,category_id,election_id 
                        from candidates  
                        where  election_id=\"$eid\"
                        order by category_id asc"; 
                      $result = mysql_query($query);  
                                  if($result) 
                                     {
                                  if(mysql_num_rows($result) > 0)
                                      {
                                   while($row = mysql_fetch_row($result))  
                                       {
                                        $cat = $db->getData("select name from categories where id = \"$row[3]\"");
                                        $n = $ut->getCandidateVotes($row[4],$row[0]);
                                        
                                         echo "<tr align='center'><td>$i</td> <td>$row[2] $row[1]</td> <td>$cat</td> <td>$n</td></tr>";
                                         
                                         
                                         $i++;
                                       }
                                      }
                                      }
                                                                                                                                                                                                                                                                                                                                     
         echo "</table>"; 
  
                        $no_of_voters = $ut->getTotalVoters($eid);
                        $no_of_votes =  $ut->getTotalVotes($eid);
                        echo "<br/><br/><p align='center' style=\"color: blue; font-size:15px;\"> Total Number of Votes: $no_of_votes";
                        echo " <br/>Total Number of Voters: $no_of_voters </p>";
                                     
                   
              
     }
   else { echo "<i style=\"color:red\">No Election Name given! </i>";  header("location: view_poll.php");  }
}
else 
    echo "<i style=\"color:red\">Erro in Database Connection </i>";
ob_end_flush();
?>
</fieldset>
</body>
</html>