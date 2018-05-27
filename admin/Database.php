<?php

/**
 * @author franco
 * @copyright 2013
 */

//connecting to database and selecting a database to use
class Database
{
  
 function isConnected()
     {
   $host="localhost";
   $username="root";
   $password="";
   $dbname ="evote";
    
    $dbms_running = mysql_connect($host,$username,$password);
    $db_available = mysql_select_db($dbname); 
    
    if(!$dbms_running)
    {
         $error = mysql_error();
         return false;
      //  return "DBMS error -->".$error;
    }
    
    if(!$db_available)
    {
         $error = mysql_error();
         return false;
       // return  "DB error -->".$error;
    }
    
    return true;
        
     }  
 
    function infoExists($query)
    {
        
       if($this->isConnected()==true)
       {
       $result = mysql_query($query);
         if(!$result)
            return false;
           // return "Db error--> ".mysql_error();
       
         if(mysql_num_rows($result)>0)
            return true;
       }
       return false;
    }   
    
    function getData($query)
    {
        $result = mysql_query($query);
         if(!$result)
          return "";
         
        if(mysql_num_rows($result)>0)
            {
         while ($row = mysql_fetch_row($result))
             {
              $a = $row[0];
             }
             return $a;
            }
            
         return "";
    }
    
    function updateDB($query)
    {
        $result = mysql_query($query);    
            if(!$result)
              {
                    return false;                                       
              }
            return true;
    }
 
}



?>