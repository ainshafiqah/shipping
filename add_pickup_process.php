<?php
include 'shippingcon.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderName = $_POST['sender_name'];
    $senderPhone = $_POST['sender_phone'];
    $senderAddress = $_POST['sender_address'];
    $pickupDate = $_POST['pickup_date'];

    $sql = "INSERT INTO CARGO_PICKUP (SENDER_NAME, SENDER_PHONE, SENDER_ADDRESS, PICKUP_DATE)
            VALUES ('$senderName', '$senderPhone', '$senderAddress', '$pickupDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Cargo pickup added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
