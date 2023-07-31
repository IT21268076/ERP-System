<!DOCTYPE html>
<html>
<head>
    <title>Item Registration Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h2>Item Registration </h2>
    
    <form action="add_item.php" method="post">
        <div class="form-group">
            <label for="item_code">Item Code:</label>
            <input type="text" id="item_code" name="item_code" required>
            <br>
        </div>

        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>
            <br>
        </div>

        <div class="form-group">
            <label for="item_category">Item Category:</label>
            <select id="item_category" name="item_category">
                <option value="Printers">Printers</option>
                <option value="Laptops">Laptops</option>
                <option value="Gadjets">Gadjets</option>
                <option value="Ink_bottles">Ink_bottles</option>
                <option value="Catridges">Catridges</option>
            </select>
            <br>
        </div>

        <div class="form-group">
            <label for="item_sub_category">Item Sub Category:</label>
            <select id="item_subcategory" name="item_subcategory">
                <option value="hp">HP</option>
                <option value="dell">Dell</option>
                <option value="lenovo">Lenovo</option>
                <option value="acer">Acer</option>
                <option value="samsung">Samsung</option>
            </select>
            <br>
        </div> 

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <br>
        </div>


        <div class="form-group">
            <label for="unit_price">Unit Price:</label>
            <input type="text" id="unit_price" name="unit_price" required>
            <br>
        </div>
        
            <input type="submit" value="Register">
        </form>
</body>
</html>

<?php
require "dbConn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $item_category = $_POST["item_category"];
    $item_subcategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];

    if (empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || empty($quantity) || empty($unit_price)) {
        echo "All fields are required.";
        exit;
    }

    if ((int) $quantity <= 0) {
        echo "Quantity should be a positive integer.";
        exit;
    }

    if ((float) $unit_price <= 0) {
        echo "Unit Price should be a positive numeric value.";
        exit;
    }

    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: item_list.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}
$conn->close();
?>
