<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payrolls</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'db.php';
    $username = $_GET['username'];
    $sql = "SELECT * FROM payroll WHERE username='$username'";
    $result = $conn->query($sql); //query will execute and stor in result varible

    echo "<h1>All Payroll Records</h1>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Emp ID</th>
        <th>Basic</th>
        <th>Allowance</th>
        <th>Deductions</th>
        <th>Net Salary</th>
        <th>Pay Date</th>
        <th>Status</th>
        <th>Designation</th>
        <th>Action</th>
        </tr>";

        while($row = $result->fetch_assoc())
        {
          echo "<tr>
          <td> ". $row['id'] ." </td>
          <td> ". $row['emp_name'] ." </td>
          <td> ". $row['emp_id'] ." </td>
          <td> ". $row['basic_salary'] ." </td>
          <td> ". $row['allowance'] ." </td>
          <td> ". $row['deductions'] ." </td>
          <td> ". $row['net_salary'] ." </td>
          <td> ". $row['pay_date'] ." </td>
          <td> ". $row['status'] ." </td>
          <td> ". $row['designation'] ."</td>
          <td>
            <a href='update_payroll.php?id= ". $row['id'] ."&username=$username '>Update</a> | 
            <a href='delete_payroll.php?id= ". $row['id'] ."&username=$username '>Delete</a> 
          </td>
        </tr>"; // . and [] is not recognized by html toh humne " " use kiye hain
        }
echo "</table>";
?> 
    <br><br>
    <h2><a href="dashboard.php?username=<?php echo $username;?>">Back to Dashboard</a></h2> 
</body>
</html>