<?php
    $username = $_GET['username'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Welcome, 
    <?php echo $username; ?>
    !</h1> 
    <br><br>
        <h3><a href="add_payroll.php?username=<?php echo $username;?>">Add Employee Payroll</a></h3><br>
        <h3><a href="view_payroll.php?username=<?php echo $username;?>">View Employee Payrolls</a></h3><br>
        <h3><a href="search.php?username=<?php echo $username;?>">Search Employee Payroll</a></h3><br>
        <h3><a href="logout.php?username=<?php echo $username;?>">Logout</a></h3>
    </div>
</body>
</html>
