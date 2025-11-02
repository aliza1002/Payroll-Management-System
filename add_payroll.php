<?php
include 'db.php';
$username = $_GET['username'];

if($_SERVER['REQUEST_METHOD'] === 'POST') 
{
        $emp_name = $_POST['emp_name'];
        $emp_id = $_POST['emp_id'];
        $basic_salary = $_POST['basic_salary'];
        $allowance = $_POST['allowance'];
        $deductions = $_POST['deductions'];
        $net_salary = $basic_salary + $allowance - $deductions;
        $pay_date = $_POST['pay_date'];
        $status = $_POST['status'];

    if ($basic_salary <= 0 || $allowance < 0 || $deductions < 0) 
    {
        echo "<p style='color:red; text-align:center;'>Invalid input! Salary must be greater than 0 and allowance/deductions cannot be negative.</p>";
    } 
    else 
    {
        //create query
        $sql = "INSERT INTO payroll (emp_name, emp_id, basic_salary, allowance, deductions, net_salary, pay_date, status, username)
                VALUES ('$emp_name', '$emp_id', '$basic_salary', '$allowance', '$deductions', '$net_salary', '$pay_date', '$status', '$username')";

        if($conn->query($sql))
        {
            echo "<br><br>";
            echo "<h1>Payroll added successfully!</h1>";
            echo "<h1><a href='view_payroll.php?username=$username'>View All Payrolls</a></h1>";
        } 
        else 
        {
          echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Employee Payroll</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Add Employee Payroll</h2>

  <form method="POST">
    <div class="input-group">
      Employee Name: <input type="text" pattern="[A-Za-z\s]+" name="emp_name" id="emp_name" title="Only letters and spaces allowed." required>
      Employee ID: <input type="text" pattern="[A-Za-z0-9]+" name="emp_id" id="emp_id" title="Only letters and numbers allowed." required>
      Basic Salary: <input type="number" name="basic_salary" id="basic_salary" required min="1" title="Salary must be greater than 0.">
      Allowance: <input type="number" name="allowance" id="allowance" required min="0" step="0.01" title="Cannot be negative.">
      Deductions: <input type="number" name="deductions" id="deductions" required min="0" step="0.01" title="Cannot be negative.">
      Pay Date: <input type="date" name="pay_date" id="pay_date" required>
      Status: <select name="status" id="status" required>
        <option value="Unpaid">Unpaid</option>
        <option value="Paid">Paid</option>
        </select>
    </div>
    <button type="submit">Add Payroll</button>
  </form>
</div>
</body>
</html>
