<?php
include 'shippingcon.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Insert data into ADMIN table
    $sql = "INSERT INTO ADMIN (USERNAME, PASSWORD, FULL_NAME, EMAIL) 
            VALUES ('$username', '$password', '$fullname', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
