<?php
require "dbConn.php";

$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "navbar.php"; ?>
    <h2>Customer Details</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>District</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"]; ?></td>
                    <td><?php echo $row["contact_no"]; ?></td>
                    <td><?php echo $row["district"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No customers found.</p>
    <?php } ?>
</body>
</html>

<?php
$conn->close();
?>
