<?php

require 'db_connection.php';

// Delete Customer
if (isset($_GET['delete_customer'])) {
    $customer_id = $_GET['delete_customer'];
    
    try {
        $stmt = $restaurant_db->prepare("DELETE FROM orders WHERE customer_id = ?");
        $stmt->execute([$customer_id]);
        
        $stmt = $restaurant_db->prepare("DELETE FROM customers WHERE customer_id = ?");
        $stmt->execute([$customer_id]);
        
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting customer: " . $e->getMessage();
    }
}

// Delete Menu Item
if (isset($_GET['delete_item'])) {
    $item_id = $_GET['delete_item'];
    
    try {
        $stmt = $restaurant_db->prepare("DELETE FROM orders WHERE item_id = ?");
        $stmt->execute([$item_id]);
        
        $stmt = $restaurant_db->prepare("DELETE FROM menuitems WHERE item_id = ?");
        $stmt->execute([$item_id]);
        
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting menu item: " . $e->getMessage();
    }
}

// Delete Order
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    
    try {
        $stmt = $restaurant_db->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->execute([$order_id]);
        
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting order: " . $e->getMessage();
    }
}
?>