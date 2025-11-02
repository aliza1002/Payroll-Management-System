<!DOCTYPE html>
<html>
<head>
<title>Register Admin</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')"; //create sql query

    if($conn->query($sql)) // conn is our connection variable where the query is executed
    {
        echo "<h1>Admin registered successfully.</h1>";
        echo "<h1><a href='login.php'>Login here</a></h1>";
    } 
    else 
    {
        echo "Error: " . $conn->error;
    }
}
?>
<h2>Register Admin</h2>
<form method="POST">
  Username: <input type="text" name="username" id="username" required><br><br> 
  Password: <input type="password" name="password" id="password" required><br><br> <!-- id is for html and name is for php -->
  <button type="submit">Register</button>
</form>
</body>
</html>
