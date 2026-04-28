<?php

require 'insert.php';

require 'update.php';

require 'delete.php';

require 'select.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple PDO CRUD</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-container">

  <!-- LEFT SIDE: FORM CONTAINER -->
  <div class="form_container">
    <div class="header">
      <h2>Simple PDO CRUD</h2>
    </div> 


   <div class="content">
         <?php
            // CHECK IF EDIT MODE
            $editUser = null;
            $editOrder = null;

            if (isset($_GET['edit'])) {
                $users_id = $_GET['edit'];

                // Fetch user data for editing
                $stmt = $pdo->prepare("SELECT * FROM users WHERE users_id = ?");
                $stmt->execute([$users_id]);
                $editUser = $stmt->fetch(PDO::FETCH_ASSOC);

                // Get order data for this user
                $stmt2 = $pdo->prepare("SELECT * FROM orders WHERE users_id = ?");
                $stmt2->execute([$users_id]);
                $editOrder = $stmt2->fetch(PDO::FETCH_ASSOC);
            }
         ?>



<!-- ADD / UPDATE FORM -->

<h3 class="section-title"><?= $editUser ? '✏️ Update User' : '➕ Add New User' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editUser)): ?>
                        <input type="hidden" name="users_id" value="<?= htmlspecialchars($editUser['users_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" value="<?= !empty($editUser) ? htmlspecialchars($editUser['name']) : '' ?>" placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" value="<?= !empty($editUser) ? htmlspecialchars($editUser['email']) : '' ?>" placeholder="Enter email address" required>
                    </div>

                    <div class="form-group">
                        <label>Product:</label>
                        <input type="text" name="product" value="<?= !empty($editOrder) ? htmlspecialchars($editOrder['product']) : '' ?>" placeholder="Enter product name" required>
                    </div>

                    <div class="form-group">
                        <label>Amount:</label>
                        <input type="number" step="0.01" name="amount" value="<?= !empty($editOrder) ? htmlspecialchars($editOrder['amount']) : '' ?>" placeholder="Enter amount" required>
                    </div>

                    <div class="btn-group">
                        <?php if (!empty($editUser)): ?>
                            <button type="submit" name="update" class="btn btn-primary">Update User</button>
                            <a href="landing.php" class="btn btn-secondary">Cancel</a>
                        <?php else: ?>
                            <button type="submit" name="add" class="btn btn-primary">Add User</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
     </div>

  <!-- Submit buttons -->


<hr>


<!-- USER TABLE -->

<div class="table_container">
     <h3 class="section-title">👥 User & New Order List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><strong>#<?= htmlspecialchars($user['users_id']) ?></strong></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['product']) ?></td>
                            <td class="amount">₱ <?= number_format(htmlspecialchars($user['amount']), 2) ?></td>
                            <td class="action-links">
                                <a href="?edit=<?= $user['users_id'] ?>" class="action-link edit-link">Edit</a>
                                <a href="?delete=<?= $user['users_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
  </div>


</body>
</html>