<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare_db";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $healthcare_db = new PDO($dsn, $username, $password, $options); 
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>