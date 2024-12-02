<?php
include 'shippingcon.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $shipment_id = $_POST['shipment_id'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $payment_status = $_POST['payment_status'];

    // Insert data into PAYMENT table
    $sql = "INSERT INTO payment (PAYMENT_METHOD, PAYMENT_DATE, PAYMENT_STATUS, USER_ID, SHIPMENT_ID) 
            VALUES ('$payment_method', '$payment_date', '$payment_status', '{$_SESSION['user_id']}', '$shipment_id')";

    if ($conn->query($sql) === TRUE) {
        // Show pop-up message
        echo "<script>alert('PAYMENT SUCCESSFUL');</script>";

        // Redirect back to the previous page (shipping_process.php)
        echo "<script>window.history.go(-2);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
