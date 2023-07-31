<?php
require "dbConn.php";

$sql = "SELECT * FROM item";
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
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Item Category</th>
                <th>Item Sub Category</th>
                <th>Quantity</th>
                <th>Unit Price</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["item_code"]; ?></td>
                    <td><?php echo $row["item_name"]; ?></td>
                    <td><?php echo $row["item_category"]; ?></td>
                    <td><?php echo $row["item_subcategory"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td><?php echo $row["unit_price"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No items found.</p>
    <?php } ?>
</body>
</html>

<?php
$conn->close();
?>
