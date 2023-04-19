<!-------------------------------------------------------------------
   db.php
   This page: 
     - demonstrates adding data to a table and issuing a query
 -------------------------------------------------------------------->
<?php
if (!isset($_SESSION)) {
   session_start();
}
?>
<html>
  <head>
	 <title>Database Operations</title>
    <style>
      body {
        background-color: rgb(220, 220, 220);
        background-size: 100%;
      }
    </style>
  </head>
  <body>
    <?php

/*********************************************************************
   connectToDB($wdb_host,$wdb_user,$wdb_pass,$wdb_name): mysqli
 *********************************************************************/
if (!function_exists('connectToDB'))   {
  function connectToDB($wdb_host,$wdb_user,$wdb_pass,$wdb_name): mysqli
    {
       $mysqli = new mysqli($wdb_host,$wdb_user,$wdb_pass,$wdb_name);
       if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }
       return $mysqli; 
    }
 }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
 $myfile = fopen('./auth/vals', "r") or die("Unable to open database settings file."); 
 $theParams=fread($myfile, filesize('./auth/vals'));
 fclose($myfile);
 $dbparams=explode(',',$theParams);

 try
 {
   $mysqli = connectToDB($dbparams[0],$dbparams[1],$dbparams[2],$dbparams[3]); 
   $query = "select * from demotable";
   print "query".$query."<br>";
   $stmt = $mysqli->prepare($query);
   $stmt->execute();
   if ($result = $stmt->get_result()) 
   {
     while ($row = $result->fetch_array(MYSQLI_NUM)) 
     { 
        for($i=0; $i<3;$i++)
          print $row[$i]."<br>"; 
     }
     $result->free(); 
     $stmt->close();        
   }
 } 
 catch (mysqli_sql_exception $e) 
 { 
   echo "MySQLi Error Code: " . $e->getCode() . "<br />";
   echo "Exception Msg: " . $e->getMessage();
   exit; // exit and close connection.
 }
 $mysqli -> close();
 unset($_POST['hiddenField']);

/*
create database testDB;

CREATE TABLE `testTable` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=CSV DEFAULT CHARSET=utf8mb4;

INSERT INTO testtable VALUES (1,'name1','description1');
INSERT INTO testtable VALUES (2,'name2','description2');
INSERT INTO testtable VALUES (3,'name3','description3');
INSERT INTO testtable VALUES (4,'name4','description4');
INSERT INTO testtable VALUES (5,'name5','description5');

select * from testTable;
*/



?>