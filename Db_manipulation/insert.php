<?php
require_once "config.php";

if (isset($_POST["add"])) {

	$name = $_POST['name'] ?? '';
	$email = $_POST['email'] ?? '';
	$product = $_POST['product'] ?? '';
	$amount = $_POST['amount'] ?? '';

	try {
        // insert into users table
		$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
		$stmt->execute([$name, $email]);
        
        // get the last inserted user id
		$user_id = $pdo->lastInsertId();
        
        // insert into orders table uisng that user_id
		$stmt2 = $pdo->prepare("INSERT INTO orders (users_id, product, amount) VALUES (?, ?, ?)");
		$stmt2->execute([$user_id, $product, $amount]);

		echo "User and order added successfully!";
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

}
?>