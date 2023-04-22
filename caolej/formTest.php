<!-------------------------------------------------------------------
   file name:   formTest.php
   Course:      COP4020
   Project:     5
   Author:      Jeremy Caole
   Description: formTest.php webpage, issues and retrieves queries.
   3 options: show all records, based on zipcode, and based on state_name

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
    <?php

    print "<div><center><h1>Query Form</h1><center></div>";

    // Read database authentication values from file
    $auth_values = read_auth_values();

    // Create a new MySQLi connection
    $conn = connect_to_database($auth_values[0], $auth_values[1], $auth_values[2], $auth_values[3]);


    print "<div><h4>Show All Entries<h4>";
    // Process form data
    if (isset($_POST['show_all'])) {
        $sql = "SELECT * FROM project5Table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            print "<table>";
            print "<tr><th>First Name</th><th>Last Name</th><th>Street Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Age</th><th>Salary</th></tr>";

            while ($row = $result->fetch_assoc()) {
                print "<tr>";
                print "<td>" . $row["first_name"] . "</td>";
                print "<td>" . $row["last_name"] . "</td>";
                print "<td>" . $row["street_address"] . "</td>";
                print "<td>" . $row["city"] . "</td>";
                print "<td>" . $row["state_name"] . "</td>";
                print "<td>" . $row["zipcode"] . "</td>";
                print "<td>" . $row["age"] . "</td>";
                print "<td>" . $row["salary"] . "</td>";
                print "</tr>";
            }
            print "</table>";
        }
    }
    if (isset($_POST['zipcode'])) {
        $zipcode = $_POST['zipcode'];
        $sql = "SELECT * FROM project5Table WHERE zipcode = '$zipcode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            print "<table>";
            print "<tr><th>First Name</th><th>Last Name</th><th>Street Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Age</th><th>Salary</th></tr>";

            while ($row = $result->fetch_assoc()) {
                print "<tr>";
                print "<td>" . $row["first_name"] . "</td>";
                print "<td>" . $row["last_name"] . "</td>";
                print "<td>" . $row["street_address"] . "</td>";
                print "<td>" . $row["city"] . "</td>";
                print "<td>" . $row["state_name"] . "</td>";
                print "<td>" . $row["zipcode"] . "</td>";
                print "<td>" . $row["age"] . "</td>";
                print "<td>" . $row["salary"] . "</td>";
                print "</tr>";
            }
            print "</table>";
        }
    }
    if (isset($_POST['state_name'])) {
        $state_name = $_POST['state_name'];
        $sql = "SELECT * FROM project5Table WHERE state_name = '$state_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            print "<table>";
            print "<tr><th>First Name</th><th>Last Name</th><th>Street Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Age</th><th>Salary</th></tr>";

            while ($row = $result->fetch_assoc()) {
                print "<tr>";
                print "<td>" . $row["first_name"] . "</td>";
                print "<td>" . $row["last_name"] . "</td>";
                print "<td>" . $row["street_address"] . "</td>";
                print "<td>" . $row["city"] . "</td>";
                print "<td>" . $row["state_name"] . "</td>";
                print "<td>" . $row["zipcode"] . "</td>";
                print "<td>" . $row["age"] . "</td>";
                print "<td>" . $row["salary"] . "</td>";
                print "</tr>";
            }
            print "</table>";
        }
    }
    $conn->close();

    // Display query choices
    print "<div><h4>Select one of the following:";
    print "<form action='formTest.php' method='post'>";
    print "<br>";
    print "<input type='checkbox' name='show_all' value='yes'><label for='show_all'>Show All Records</label>";
    print "<br><br>";
    print "<label for='zipcode'>Find by zip code : </label><input type='text' name='zipcode' value=''>";
    print "<br>";
    print "<label for='state_name'>Find by State : </label><input type='text' name='state_name' value=''>";
    print "<br><br>";
    print "<input type='submit' value='Click to Issue Query'>";
    print "</form></div>";
    ?>
</body>

</html>