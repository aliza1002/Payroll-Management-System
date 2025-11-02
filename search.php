<?php
include 'db.php';
$username = $_GET['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Payroll</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Search Employee Payroll</h2>

    <form method="GET">
        <label for="search">Enter Employee Name or ID:</label> <!-- to connect search field with label -->
        <input type="text" id="search" name="search" placeholder="e.g., Name or Employee ID" required>
        <input type="hidden" id="username" name="username" value="<?php echo $username; ?>"> <!-- to retain username in GET request -->
        <button type="submit">Search</button>
    </form>
    <br>

    <?php
    if(!empty($_GET['search']))
    { 
        $search = $_GET['search'];
        $sql = "SELECT * FROM payroll WHERE emp_name LIKE '%$search%' OR emp_id LIKE '%$search%'";
        $result = $conn->query($sql);

        if(!$result) 
        {
            echo "<p style='color:red;'>Error in query: " . $conn->error . "</p>";
        } 
        elseif($result->num_rows > 0) 
        {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Emp ID</th>
                        <th>Basic Salary</th>
                        <th>Allowance</th>
                        <th>Deductions</th>
                        <th>Net Salary</th>
                        <th>Pay Date</th>
                        <th>Status</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) 
            {
                if ($row['status'] === 'Paid')  // === checks value and datatype
                {
                    $statusClass = 'status-paid'; // seelcting the css class
                } 
                else 
                {
                    $statusClass = 'status-unpaid';
                }
                echo "<tr>
                        <td> ". $row['id'] ." </td>
                        <td> ". $row['emp_name'] ." </td>
                        <td> ". $row['emp_id'] ." </td>
                        <td> ". $row['basic_salary'] ." </td>
                        <td> ". $row['allowance'] ." </td>
                        <td> ". $row['deductions'] ." </td>
                        <td> ". $row['net_salary'] ." </td>
                        <td> ". $row['pay_date'] ." </td>
                        <td class='{$statusClass}'> ". $row['status'] ." </td>
                    </tr>";
            }

            echo "</table>";
        } 
        else 
        {
            echo "<p style='text-align:center;'>No results found for '<b>$search</b>'</p>"; // here <b> indicates bold
        }
    }
    ?>

    <br>
    <a href="view_payroll.php?username=<?php echo $username; ?>" class="button">⬅ Back to Dashboard</a>
</div>
</body>
</html>
