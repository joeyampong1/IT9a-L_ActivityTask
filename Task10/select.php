<?php
require "config.php";

$stmt = $pdo->query('SELECT
            u.users_id, 
            u.name, 
            u.email,
            o.oders_id,        
            o.product,
            o.amount
        FROM users u
        LEFT JOIN orders o ON u.users_id = o.users_id  
        ORDER BY u.users_id DESC
    ');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // print_r($users); // 

?>