<?php
require "dbConn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $sql = "SELECT i.invoice_no, i.date, c.first_name, c.district, COUNT(im.item_id) AS item_count, SUM(im.amount) AS invoice_amount
            FROM invoice i
            INNER JOIN customer c ON i.customer = c.id
            INNER JOIN invoice_master im ON i.invoice_no = im.invoice_no
            WHERE i.date BETWEEN ? AND ?
            GROUP BY i.invoice_no";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include "navbar.php"; ?>
    <h2>Invoice Report</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Customer District</th>
                <th>Item Count</th>
                <th>Invoice Amount</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["invoice_no"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["first_name"]; ?></td>
                    <td><?php echo $row["district"]; ?></td>
                    <td><?php echo $row["item_count"]; ?></td>
                    <td><?php echo $row["invoice_amount"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No invoices found for the selected date range.</p>
    <?php } ?>
</body>
</html>

<?php
    $stmt->close();
}
$conn->close();
?>
