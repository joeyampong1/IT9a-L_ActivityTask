<?php
session_start();
$session_id = session_id();
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$users = ["admin" => "1234",
          "joey" => "pass123",
          "student1" => "abc123"
          ];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // check if the username exists and the password matches
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    username: <input type="text" name="username" required><br><br>
    password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<script>
    let phpSessionID = "<?php echo $session_id; ?>";
    sessionStorage.setItem("session_id", phpSessionID);
</script>
    
</body>
</html>