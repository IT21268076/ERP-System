<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration Form</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <?php include "navbar.php"; ?>
    <h2>Customer Registration</h2>
    <form action="add_customer.php" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <select id="title" name="title">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr</option>
            </select>
        </div>

        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" name="fname" id="fname" required>
        </div>

        <div class="form-group">
            <label for="middleName">Middle Name:</label>
            <input type="text" name="mname" id="mname" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lname" id="lname" required>
        </div>

        <div class="form-group">
            <label for="contactNo">Contact No:</label>
            <input type="text" name="cNo" id="cNo" required>
        </div>

        <div class="form-group">
            <label for="district">District:</label>
            <input type="text" name="district" id="district" required>
        </div>

        <input type="submit" value="Register">
    </form>
</body>
</html>

<?php

require "dbConn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $first_name = $_POST["fname"];
    $middle_name = $_POST["mname"];
    $last_name = $_POST["lname"];
    $contact_number = $_POST["cNo"];
    $district = $_POST["district"];

    if (empty($title) || empty($first_name) || empty($middle_name) || empty($last_name) || empty($contact_number) || empty($district)) {
        echo "All fields are required.";
        exit;
    }

    if (!preg_match("/^[A-Za-z]+$/", $first_name) || !preg_match("/^[A-Za-z]+$/", $middle_name) || !preg_match("/^[A-Za-z]+$/", $last_name)) {
        echo "First Name, Middle Name, and Last Name should contain only alphabetic characters.";
        exit;
    }

    if (!preg_match("/^[0-9]+$/", $contact_number)) {
        echo "Contact Number should contain only numeric characters.";
        exit;
    }

    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
            VALUES ('$title', '$first_name', '$middle_name','$last_name', '$contact_number', '$district')";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer_list.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

   
}

$conn->close();
?>






