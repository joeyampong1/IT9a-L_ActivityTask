<?php
// insert.php
require 'db_connection.php';

// Add Customer
if (isset($_POST['add_customer'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    
    try {
        $stmt = $restaurant_db->prepare("INSERT INTO customers (first_name, last_name, phone_number) VALUES (?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone_number]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding customer: " . $e->getMessage();
    }
}

// Add Menu Item
if (isset($_POST['add_item'])) {
    $dish_name = $_POST['dish_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    try {
        $stmt = $restaurant_db->prepare("INSERT INTO menuitems (dish_name, price, category) VALUES (?, ?, ?)");
        $stmt->execute([$dish_name, $price, $category]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding menu item: " . $e->getMessage();
    }
}

// Add Order
if (isset($_POST['add_order'])) {
    $customer_id = $_POST['customer_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $order_date = date('Y-m-d H:i:s');
    
    try {
        $stmt = $restaurant_db->prepare("INSERT INTO orders (customer_id, item_id, quantity, order_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_id, $item_id, $quantity, $order_date]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding order: " . $e->getMessage();
    }
}
?>