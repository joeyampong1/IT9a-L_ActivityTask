<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
require 'db_connection.php'; 

// Initialize variables 
if (!isset($customers)) $customers = [];
if (!isset($items)) $items = [];
if (!isset($orders)) $orders = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Restaurant CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- MAIN CONTAINER -->
    <div class="main-container">

        <!-- HEADER - Full Width -->
        <div class="header">
            <h2>🍽️ Simple Restaurant CRUD</h2>
        </div>
        
        <!-- LEFT SIDE: CUSTOMER SECTION -->
        <div class="customer-section">
            <?php
            // CHECK IF EDIT MODE
            $editCustomer = null;
            $editItem = null;
            $editOrder = null;

            if (isset($_GET['edit_customer'])) {
                $customer_id = $_GET['edit_customer'];
                
                // Fetch customer data for edit
                $stmt = $restaurant_db->prepare("SELECT * FROM customers WHERE customer_id = ?");
                $stmt->execute([$customer_id]);
                $editCustomer = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
            if (isset($_GET['edit_item'])) {
                $item_id = $_GET['edit_item'];
                
                // Fetch item data for edit
                $stmt = $restaurant_db->prepare("SELECT * FROM menuitems WHERE item_id = ?");
                $stmt->execute([$item_id]);
                $editItem = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
            if (isset($_GET['edit_order'])) {
                $order_id = $_GET['edit_order'];
                
                // Fetch order data for edit
                $stmt = $restaurant_db->prepare("SELECT * FROM orders WHERE order_id = ?");
                $stmt->execute([$order_id]);
                $editOrder = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>

            <h3 class="section-title"><?= !empty($editCustomer) ? '✏️ Update Customer' : '➕ Add New Customer' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editCustomer)): ?>
                        <input type="hidden" name="customer_id" value="<?= htmlspecialchars($editCustomer['customer_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>First Name:</label>
                        <input type="text" name="first_name" value="<?= !empty($editCustomer) ? htmlspecialchars($editCustomer['first_name']) : '' ?>" placeholder="Enter first name" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" name="last_name" value="<?= !empty($editCustomer) ? htmlspecialchars($editCustomer['last_name']) : '' ?>" placeholder="Enter last name" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="text" name="phone_number" value="<?= !empty($editCustomer) ? htmlspecialchars($editCustomer['phone_number']) : '' ?>" placeholder="Enter phone number" required>
                    </div>

                    <div class="btn-group">
                        <?php if (!empty($editCustomer)): ?>
                            <button type="submit" name="update_customer" class="btn btn-primary">Update Customer</button>
                            <a href="landing.php" class="btn btn-secondary">Cancel</a>
                        <?php else: ?>
                            <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <hr>

            <h3 class="section-title">Customer List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($customer['customer_id']) ?></strong></td>
                                <td><?= htmlspecialchars($customer['first_name']) ?></td>
                                <td><?= htmlspecialchars($customer['last_name']) ?></td>
                                <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                                <td class="action-links">
                                    <a href="?edit_customer=<?= $customer['customer_id'] ?>" class="action-link edit-link">Edit</a>
                                    <a href="?delete_customer=<?= $customer['customer_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No customers found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT SIDE: MENU ITEM SECTION -->
        <div class="item-section">
            <h3 class="section-title"><?= !empty($editItem) ? '✏️ Update Menu Item' : '➕ Add New Menu Item' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editItem)): ?>
                        <input type="hidden" name="item_id" value="<?= htmlspecialchars($editItem['item_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Dish Name:</label>
                        <input type="text" name="dish_name" value="<?= !empty($editItem) ? htmlspecialchars($editItem['dish_name']) : '' ?>" placeholder="Enter dish name" required>
                    </div>

                    <div class="form-group">
                        <label>Price:</label>
                        <input type="number" step="0.01" name="price" value="<?= !empty($editItem) ? htmlspecialchars($editItem['price']) : '' ?>" placeholder="Enter price" required>
                    </div>

                    <div class="form-group">
                        <label>Category:</label>
                        <input type="text" name="category" value="<?= !empty($editItem) ? htmlspecialchars($editItem['category']) : '' ?>" placeholder="Enter Category" required>
                    </div>

                    <div class="btn-group">
                        <?php if (!empty($editItem)): ?>
                            <button type="submit" name="update_item" class="btn btn-primary">Update Item</button>
                            <a href="landing.php" class="btn btn-secondary">Cancel</a>
                        <?php else: ?>
                            <button type="submit" name="add_item" class="btn btn-primary">Add Item</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <hr>

            <h3 class="section-title">Menu Item List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dish Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items)): ?>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($item['item_id']) ?></strong></td>
                                <td><?= htmlspecialchars($item['dish_name']) ?></td>
                                <td>₱ <?= number_format(htmlspecialchars($item['price']), 2) ?></td>
                                <td><?= htmlspecialchars($item['category']) ?></td>
                                <td class="action-links">
                                    <a href="?edit_item=<?= $item['item_id'] ?>" class="action-link edit-link">Edit</a>
                                    <a href="?delete_item=<?= $item['item_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No menu items found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BOTTOM SECTION: ORDERS (FULL WIDTH) -->
        <div class="order-section">
            <h3 class="section-title"><?= !empty($editOrder) ? '✏️ Update Order' : '➕ Add New Order' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editOrder)): ?>
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($editOrder['order_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Customer:</label>
                        <select name="customer_id" required>
                            <option value="">Select Customer</option>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $customer): ?>
                                <option value="<?= $customer['customer_id'] ?>" <?= (!empty($editOrder) && $editOrder['customer_id'] == $customer['customer_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?>
                                </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Menu Item:</label>
                        <select name="item_id" required>
                            <option value="">Select Menu Item</option>
                            <?php if (!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                <option value="<?= $item['item_id'] ?>" <?= (!empty($editOrder) && $editOrder['item_id'] == $item['item_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($item['dish_name']) ?> - ₱<?= number_format($item['price'], 2) ?>
                                </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" value="<?= !empty($editOrder) ? htmlspecialchars($editOrder['quantity']) : '1' ?>" min="1" required>
                    </div>

                    <div class="btn-group">
                        <?php if (!empty($editOrder)): ?>
                            <button type="submit" name="update_order" class="btn btn-primary">Update Order</button>
                            <a href="landing.php" class="btn btn-secondary">Cancel</a>
                        <?php else: ?>
                            <button type="submit" name="add_order" class="btn btn-primary">Add Order</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <hr>

            <h3 class="section-title">Order List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Dish Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($order['order_id']) ?></strong></td>
                                <td><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></td>
                                <td><?= htmlspecialchars($order['dish_name']) ?></td>
                                <td><?= htmlspecialchars($order['quantity']) ?></td>
                                <td>₱ <?= number_format(htmlspecialchars($order['total_price']), 2) ?></td>
                                <td><?= htmlspecialchars($order['order_date']) ?></td>
                                <td class="action-links">
                                    <a href="?edit_order=<?= $order['order_id'] ?>" class="action-link edit-link">Edit</a>
                                    <a href="?delete_order=<?= $order['order_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">No orders found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>