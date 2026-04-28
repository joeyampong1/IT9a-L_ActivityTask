<?php
// update.php
require 'db_connection.php';

// Update Customer
if (isset($_POST['update_customer'])) {
    $customer_id = $_POST['customer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    
    try {
        $stmt = $restaurant_db->prepare("UPDATE customers SET first_name = ?, last_name = ?, phone_number = ? WHERE customer_id = ?");
        $stmt->execute([$first_name, $last_name, $phone_number, $customer_id]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating customer: " . $e->getMessage();
    }
}

// Update Menu Item
if (isset($_POST['update_item'])) {
    $item_id = $_POST['item_id'];
    $dish_name = $_POST['dish_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    try {
        $stmt = $restaurant_db->prepare("UPDATE menuitems SET dish_name = ?, price = ?, category = ? WHERE item_id = ?");
        $stmt->execute([$dish_name, $price, $category, $item_id]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating menu item: " . $e->getMessage();
    }
}

// Update Order
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    
    try {
        $stmt = $restaurant_db->prepare("UPDATE orders SET customer_id = ?, item_id = ?, quantity = ? WHERE order_id = ?");
        $stmt->execute([$customer_id, $item_id, $quantity, $order_id]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating order: " . $e->getMessage();
    }
}
?>