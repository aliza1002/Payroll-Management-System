<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
     $username = $_POST['username'];
     $password = $_POST['password'];

     $sql = "SELECT * FROM admin WHERE username='$username'"; //read quuery from db

     $result = $conn->query($sql);

      if($result->num_rows > 0) 
      {
        $row = $result->fetch_assoc();
        if($password == $row['password']) // == checks only value not datatype
        {
            echo "<br><br><h1 class='login-container'>Login successful! 
            <br><br><a href='dashboard.php?username=$username'>Go to Dashboard</a></h1>"; // ? means sending to $_GET
            exit; // break out of PHP to prevent form from showing again
        } 
        else 
        {
            echo "<h1>Invalid Password!</h1>";
        }
    } 
    else 
    {
     echo "<h1>User not found!</h1>";
    }
}
?>

    <div class="login-container" class="login-container form input">
    <h2>Admin Login</h2><br>
    <form method="POST">
        Username: <input type="text" name="username" id="username" required>
        Password: <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
    </div>
</form>
</body>
</html>
