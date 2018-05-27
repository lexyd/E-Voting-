<?php

/**
 * @author franco
 * @copyright 2013
 */


class Util
{
  
  function emptyFields($fields)
  {
    $no_of_fields = count($fields);
    $count=0;
    for($i =0; $i<$no_of_fields;$i++)
    {
        $value = $fields[$i];
        if($value=="")
          $count++;
          
    }
    
    return $count;
  }
    
  function getCandidateVotes($election_id,$candidate_id)
    {
    $query = "select candidate_id from ballotbox where (election_id='$election_id') and (candidate_id='$candidate_id')";
     
     $result = mysql_query($query);
     
        if($result)
         {   $count = mysql_num_rows($result);
                return $count;           
         }
         return -1;
    }
  
  function getTotalVotes($election_id)
 { 
     $query = "select voter_id from ballotbox where election_id='$election_id'";

     $result = mysql_query($query);
     
        if($result)
         {   $count = mysql_num_rows($result);
                return $count;           
         }
      return -1;
 }
 
 function getTotalVoters($election_id)
 {
    $query = "select distinct voter_id from ballotbox where election_id='$election_id'";

     $result = mysql_query($query);
     
        if($result)
         {   $count = mysql_num_rows($result);
                return $count;           
         }
        return -1;
 }
}


?>