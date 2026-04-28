<?php
session_start();
$sesssion_id = session_id();
// if session is not set, rediretct to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welocome Page</title>
</head>
<body>

<h2>Welcome Page</h2>

<p>Hi, <?php echo $_SESSION['username']; ?>!</p>

<a hreaf="logout.php">Logout</a>
    
</body>

<Script>
    let phpSessionID = "<?php echo $sesssion_id; ?>";
    sessionStorage.setItem("session_id", phpSessionID);
    console.log("Session ID:", phpSessionID);
</Script>
</html>