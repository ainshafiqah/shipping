<?php
session_start();
include 'shippingcon.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the admin exists
    $sql = "SELECT * FROM ADMIN WHERE USERNAME='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['PASSWORD'])) {
            // Authentication successful
            $_SESSION['admin_id'] = $row['ADMIN_ID'];
            $_SESSION['admin_username'] = $row['USERNAME'];
            $_SESSION['admin_fullname'] = $row['FULL_NAME'];
            // Redirect to admin dashboard or any other authenticated page
            header("Location: admin_orders.php");
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Admin not found. Please check your username.";
    }
}

$conn->close();
?>
