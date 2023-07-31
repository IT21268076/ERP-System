<?php
require "dbConn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $sql = "SELECT i.invoice_no, i.date AS invoiced_date, c.first_name, im.item_id, it.item_name, it.item_code, it.item_category, it.unit_price
            FROM invoice i
            INNER JOIN customer c ON i.customer = c.id
            INNER JOIN invoice_master im ON i.invoice_no = im.invoice_no
            INNER JOIN item it ON im.item_id = it.id
            WHERE i.date BETWEEN ? AND ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Item Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include "navbar.php"; ?>
    <h2>Invoice Item Report</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Invoice Number</th>
                <th>Invoiced Date</th>
                <th>Customer Name</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Item Category</th>
                <th>Item Unit Price</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["invoice_no"]; ?></td>
                    <td><?php echo $row["invoiced_date"]; ?></td>
                    <td><?php echo $row["first_name"]; ?></td>
                    <td><?php echo $row["item_code"]; ?></td>
                    <td><?php echo $row["item_name"]; ?></td>
                    <td><?php echo $row["item_category"]; ?></td>
                    <td><?php echo $row["unit_price"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No invoice items found for the selected date range.</p>
    <?php } ?>
</body>
</html>

<?php
    $stmt->close();
}
$conn->close();
?>
