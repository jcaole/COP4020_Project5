<!DOCTYPE html>
<html>
<body>
  <h4>This is an example PHP page</h4>
  <?php
    $greeting = "My first PHP script!";
    print $greeting."<br><br>";
    $total = 6 + 5;
    print "total is: ".$total;
    for($i=0; $i<10;$i++)
    {
      $total +=2;
      print "the new total is: ".$total."<br>";
    }
  ?>
</body>
</html>