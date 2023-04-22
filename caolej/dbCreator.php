<!-------------------------------------------------------------------
   file name:   dbCreator.php
   Course:      COP4020
   Project:     5
   Author:      Jeremy Caole
   Description: drops and creates project5Table. reads data from table
   and displays data.
 -------------------------------------------------------------------->

<?php
require('db.php');

if (!isset($_SESSION)) {
    session_start();
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>dbCreator</title>
    <style>
        body {
            background-color: rgb(220, 220, 220);
            background-size: 100%;
        }
    </style>
</head>

<body>
    <!-- <h1>Create Table and Data</h1> -->
    <?php
    // require('db.php');


    print "<center> <h1>Create Table and Data</h1></center>";
    // Read database authentication values from file
    $auth_values = read_auth_values();

    // Create a new MySQLi connection
    $conn = connect_to_database($auth_values[0], $auth_values[1], $auth_values[2], $auth_values[3]);

    // Drop table if exists
    drop_table($conn);


    // Create table
    create_table($conn);


    // Read data from file and insert into table
    print "Reading data.csv <br>";

    read_file($conn);

    // Display button to go to formTest.php
    print "<br><form action='formTest.php' method='post'>
        <input type='submit' value='Go to the query page'>
      </form>";
    ?>
</body>

</html>