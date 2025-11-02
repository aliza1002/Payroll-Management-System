<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Payroll</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'db.php';

$id = $_GET['id']; // for updating
$username = $_GET['username']; // for staying logged in
$result = $conn->query("SELECT * FROM payroll WHERE id=$id");
$row = $result->fetch_assoc(); // so that the data remains in the fields

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
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
        $sql = "UPDATE payroll SET basic_salary='$basic_salary', allowance='$allowance', deductions='$deductions', net_salary='$net_salary', pay_date='$pay_date', status='$status' WHERE id=$id";
        if($conn->query($sql))
        {
            echo "<h1>Payroll updated successfully.</h1>";
            echo "<h2><a href='view_payroll.php?username=$username'>View All Payrolls</a></h2>";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
        }
}
?>

  <h2>Update Payroll</h2>
  <form method="POST">
  Basic Salary: <input type="number" name="basic_salary" value="<?php echo $row['basic_salary']; ?>" min="1" title="Salary must be greater than 0." required>
  Allowance: <input type="number" name="allowance" value="<?php echo $row['allowance']; ?>" min="0" step="0.01" title="Cannot be negative." required>
  Deductions: <input type="number" name="deductions" value="<?php echo $row['deductions']; ?>" min="0" step="0.01" title="Cannot be negative." required>
  Pay Date: <input type="date" name="pay_date" value="<?php echo $row['pay_date']; ?>" required>
  Status:
      <select name="status" id="status" required>
      <option value="Unpaid" <?php if ($row['status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
      <option value="Paid" <?php if ($row['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
      </select>
  <button type="submit">Update</button>
</form>
</body>
</html>
