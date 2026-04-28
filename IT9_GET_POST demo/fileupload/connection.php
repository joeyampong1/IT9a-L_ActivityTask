<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "journal_system";


// create connection
$conn = new mysqli($servername, $username, $password, $db);

// check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";


?>