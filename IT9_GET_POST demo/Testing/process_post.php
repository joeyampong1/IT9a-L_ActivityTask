<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['age'])) {
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);

    $name_safe = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $age_safe = htmlspecialchars($age, ENT_QUOTES, 'UTF-8');

    echo "<h2>POST Data Received</h2>";
    echo "<p>Name: $name_safe</p>";
    echo "<p>Age: $age_safe</p>";
    echo "<p>Notice the data was sent in the request body (not the URL).</p>";
} else {
    echo "No POST data received.";
}

?>