<!-------------------------------------------------------------------
   file name:   db.php
   Course:      COP4020
   Project:     5
   Author:      Jeremy Caole
   Description: This file defines functions for connecting to a MySQL database 
   and manipulating data in the project5Table.

 -------------------------------------------------------------------->
 <?php
// if (!isset($_SESSION)) {
//   session_start();
// }

/**
 * Reads authentication values for the MySQL database from a vals file.
 */
if (!function_exists('read_auth_values')) {
  function read_auth_values()
  {
    // Read database authentication values from vals
    $vals_path = __DIR__ . "/auth/vals";
    $vals = file($vals_path);

    // Separate the connection parameters
    $host = ($vals[0]);
    $host_parts = explode(',', $host);
    if (count($host_parts) < 4) {
      die("Error: Invalid authentication values in $vals_path");
    }
    $db_host = $host_parts[0];
    $db_user = $host_parts[1];
    $db_pass = $host_parts[2];
    $db_name = $host_parts[3];

    return [$db_host, $db_user, $db_pass, $db_name];
  }
}

/**
 * Creates a new MySQLi connection using the parameters.
 */
if (!function_exists('connect_to_database')) {
  function connect_to_database($db_host, $db_user, $db_pass, $db_name)
  {
    // Create a new MySQLi connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check if the connection was successful
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }
}

/**
 * Drops the project5Table from the connected database if it exists.
 *
 * @param mysqli $conn The MySQLi connection.
 */
if (!function_exists('drop_table')) {
  function drop_table($conn)
  {
    // Drop table if exists
    $sql = "DROP TABLE IF EXISTS project5Table";
    if ($conn->query($sql) === TRUE) {
      print "command [drop TABLE project5Table]<br>";
    } else {
      print "Error dropping table: " . $conn->error;
    }
  }
}

/**
 * Creates a MySQL table based on given attributes
 */
if (!function_exists('create_table')) {
  function create_table($conn)
  {
    // Create table
    $sql = "CREATE TABLE project5Table (
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    street_address varchar(50) NOT NULL,
    city varchar(20) NOT NULL,
    state_name varchar(5) NOT NULL,
    zipcode text NOT NULL,
    age varchar(5) NOT NULL,
    salary varchar(15) NOT NULL
  ) ENGINE=CSV DEFAULT CHARSET=utf8mb4";

    if ($conn->query($sql) === TRUE) {
      print "Table project5Table created successfully";
    } else {
      print "Error creating table: " . $conn->error;
    }
    print "command [$sql]<br><br>";
  }
}


/**
 * Reads data from a CSV file and inserts it into a MySQL table
 */
if (!function_exists('read_file')) {
  function read_file($conn)
  {
    $filename = "data.csv";
    $file = fopen($filename, "r");

    while (($line = fgets($file)) !== false) {
      $data = explode(";", ($line));

      print implode(";<br>", $data) . "<br><br>";

      foreach ($data as $entry) {
        $fields = explode(",", $entry);

        $first_name = $fields[0];
        $last_name = $fields[1];
        $street_address = $fields[2];
        $city = $fields[3];
        $state_name = $fields[4];
        $zipcode = $fields[5];
        $age = $fields[6];
        $salary = $fields[7];

        $sql = "INSERT INTO project5Table (first_name, last_name, street_address, city, state_name, zipcode, age, salary)
          VALUES ('$first_name', '$last_name', '$street_address', '$city', '$state_name', '$zipcode', '$age', '$salary')";


        if ($conn->query($sql) === TRUE) {
          print "command insert into project5Table values(\"$first_name\",\"$last_name\",\"$street_address\",\"$city\",\"$state_name\",\"$zipcode\",\"$age\",\"$salary\");<br>";
        } else {
          print "Error inserting data: " . $conn->error;
        }
      }
    }
    fclose($file);
    $conn->close();
  }
}

?>