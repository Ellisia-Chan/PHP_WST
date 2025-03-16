<?php

// Establish a connection to the MySQL database server
// The parameters are: hostname, username, password, database name
$connections = mysqli_connect("localhost", "root", "", "myDB");

// Check if there was an error connecting
if (mysqli_connect_errno()) {
    // If there was an error, display it
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
