
<?php
require 'config.php';

if (!isset($pdo) && isset($pdo_n)) {
    $pdo = $pdo_n;
}

try {
    $sql = "
        SELECT
            u.users_id AS user_id,
            u.name,
            u.email,
            o.orders_id AS order_id,
            o.product,
            o.amount
        FROM users u
        LEFT JOIN oders o ON u.users_id = o.user_id
        ORDER BY u.users_id, o.orders_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Database error: ' . htmlspecialchars($e->getMessage());
    exit;
}

echo '<table border="1" cellpadding="4" cellspacing="0">';
echo '<thead><tr><th>User ID</th><th>Name</th><th>Email</th><th>Order ID</th><th>Product</th><th>Amount</th></tr></thead><tbody>';

foreach ($rows as $r) {
    echo '<tr>'
        . '<td>' . htmlspecialchars($r['user_id']) . '</td>'
        . '<td>' . htmlspecialchars($r['name']) . '</td>'
        . '<td>' . htmlspecialchars($r['email']) . '</td>'
        . '<td>' . ($r['order_id'] !== null ? htmlspecialchars($r['order_id']) : '') . '</td>'
        . '<td>' . ($r['product'] !== null ? htmlspecialchars($r['product']) : '') . '</td>'
        . '<td>' . ($r['amount'] !== null ? htmlspecialchars($r['amount']) : '') . '</td>'
        . '</tr>';
}

echo '</tbody></table>';
?>
