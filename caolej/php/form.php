<!-------------------------------------------------------------------
   Form.php
   This page: 
     - demonstrates a form and processing it on the same page
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
     if(isset($_POST['hiddenField']))
     {
       print'<center> <h2>Parameter Processing</h2></center>';
       foreach($_POST as $key => $value)
       {
         print "Attribute = ".$key."<br>";
         print "Value     = ".$value."<br><br>";  
       }
       unset($_POST['hiddenField']);
     }
     else
     {
        print"<center><h2> Demo input</h2></center>";
        print'<form action="form.php" method="POST">';
        print'<input type="hidden" name="hiddenField" value="hiddenValue">'; 
        print'Enter some data:<br/>';
        print'<input type="text" size="50" name="testParameter" value="test"><br/>'; 
        print'Enter a brief description <br/>';
        print '<input type="text" size="50" name="numParameters"><br/><br/>';
        print'<input type="submit" value="Click to Submit"> <br/><br/></form>';
      }
            
    ?> 
  </body> 
</html>


