<!-------------------------------------------------------------------
   session2.php
   This page: 
     - demonstrates prsistence of a session variable
 -------------------------------------------------------------------->
<?php
if (!isset($_SESSION)) {
   session_start();
}
?>
<html>
  <head>
	 <title>Form Demo</title>
    <style>
      body {
        background-color: rgb(220, 220, 220);
        background-size: 100%;
      }
    </style>
  </head>
  <body>
    <?php
      if(isset($_SESSION['sessionDemo']))
      {
         print"See, it is still set! ".$_SESSION['sessionDemo']."<br><br>";
      }
      else
      {
        print"Oh crud, the session variable is not set.<br><br>";
      }
    ?> 
  </body> 