<?php
include "connection.php";
if(isset($_POST["upload"])){

$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];
$tempname = $_FILES['file']['temp'];

// get file content
$filedata = addslashes(file_get_contents($tempname));

// insert into database
$sql = "INSERT INTO files (filename, filetype, filedata) VALUES ('$filename', '$filetype', '$filedata')";

mysqli_query($conn, $sql);

echo"File Uploaded successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF or Image</title>
</head>
<body>
    <h2>Upload PDF or Picture</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <br><br>
        <button type="submit" name="upload">Upload</button>
    </form>
    
</body>
</html>