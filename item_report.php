<?php

require "dbConn.php";

$sql = "SELECT i.item_name, i.item_category, i.item_subcategory, SUM(i.quantity) AS total_quantity
        FROM item i
        GROUP BY i.item_name, i.item_category, i.item_subcategory";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h2>Item Report</h2>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Item Category</th>
            <th>Item Subcategory</th>
            <th>Item Quantity</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["item_name"]; ?></td>
                <td><?php echo $row["item_category"]; ?></td>
                <td><?php echo $row["item_subcategory"]; ?></td>
                <td><?php echo $row["total_quantity"]; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
