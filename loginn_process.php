<?php
include 'shippingcon.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['PASSWORD'])) {
            // Authentication successful
            $_SESSION['user_id'] = $row['USER_ID']; // Assuming USER_ID is the column name for user ID
            $_SESSION['user_email'] = $row['EMAIL'];
            
            header("Location: shippingg_details.php"); // Redirect to the dashboard or any other authenticated page
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your email.";
    }
}

$conn->close();
?>
