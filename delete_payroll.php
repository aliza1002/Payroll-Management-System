<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Payroll</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'db.php';

    $username = $_GET['username'];
    $id = $_GET['id'];
    $sql = "DELETE FROM payroll WHERE id=$id";

    if ($conn->query($sql)) 
    {
         echo "Record deleted successfully.";
         echo "<a href='view_payroll.php?username=$username'>View All Payrolls</a>";  
    } 
    else 
    {
         echo "Error deleting record.";
    }
?>
</body>
</html>