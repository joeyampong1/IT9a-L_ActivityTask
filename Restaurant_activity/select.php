<?php
// select.php
require 'db_connection.php';

// Initialize variables
$customers = [];
$items = [];
$orders = [];

try {
    // Fetch customers
    $stmt = $restaurant_db->query("SELECT * FROM customers ORDER BY customer_id DESC");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching customers: " . $e->getMessage();
}

try {
    // Fetch menu items
    $stmt = $restaurant_db->query("SELECT * FROM menuitems ORDER BY item_id DESC");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching menu items: " . $e->getMessage();
}

try {
    // Fetch orders with joins to get customer and item names
    $stmt = $restaurant_db->query("
        SELECT o.*, 
               c.first_name, 
               c.last_name, 
               m.dish_name, 
               m.price,
               (o.quantity * m.price) as total_price
        FROM orders o
        LEFT JOIN customers c ON o.customer_id = c.customer_id
        LEFT JOIN menuitems m ON o.item_id = m.item_id
        ORDER BY o.order_date DESC
    ");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching orders: " . $e->getMessage();
}
?>