<!-------------------------------------------------------------------
   session.php
   This page: 
     - demonstrates a session variable
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
      print"<center><h2>Session Variable Demo</h2></center>";
      print'<form action="session2.php" method="POST">';
      print'<input type="hidden" name="hiddenField" value="hiddenValue">'; 
      print'Enter some data:<br/>';
      print'<input type="text" size="50" name="testParameter" value="test"><br/>'; 
      print'Enter a brief description <br/>';
      print '<input type="text" size="50" name="numParameters"><br/><br/>';
      print'<input type="submit" value="Click to Submit"> <br/><br/></form>';
      
      if(isset($_SESSION['sessionDemo']))
      {
         print"See, it is still set! ".$_SESSION['sessionDemo']."<br><br>";
      }
      else
      {
        $_SESSION['sessionDemo'] = "This is the value of a session variable<br>";
      }
    ?> 
  </body> 
</html>


