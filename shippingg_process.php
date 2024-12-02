<?php
include 'shippingcon.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $sender_name = $_POST['sender_name'];
    $sender_phone = $_POST['sender_phone'];
    $sender_address = $_POST['sender_address'];
    $sender_state = $_POST['sender_state'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone = $_POST['receiver_phone'];
    $receiver_address = $_POST['receiver_address'];
    $receiver_state = $_POST['receiver_state'];
    $shipment_weight = $_POST['shipment_weight'];
    $total_price = $_POST['total_price'];

    // Insert data into SHIPMENTS table
    $sql = "INSERT INTO shipments (SENDER_NAME, SENDER_PHONE, SENDER_ADDRESS, SHIP_FROM, RECEIVER_NAME, RECEIVER_PHONE, RECEIVER_ADDRESS, SHIP_TO, SHIPMENT_WEIGHT, TOTAL_PRICE, USER_ID) 
            VALUES ('$sender_name', '$sender_phone', '$sender_address', '$sender_state', '$receiver_name', '$receiver_phone', '$receiver_address', '$receiver_state', '$shipment_weight', '$total_price', '{$_SESSION['user_id']}')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve inserted data
        $shipment_id = $conn->insert_id;
        $sql_select = "SELECT * FROM shipments WHERE SHIPMENT_ID = $shipment_id";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Display the data
            echo "<h2>Shipment Details</h2>";
            echo "<p><strong>Sender Name:</strong> " . $row["SENDER_NAME"] . "</p>";
            echo "<p><strong>Sender Phone:</strong> " . $row["SENDER_PHONE"] . "</p>";
            echo "<p><strong>Sender Address:</strong> " . $row["SENDER_ADDRESS"] . "</p>";
            echo "<p><strong>Ship From:</strong> " . $row["SHIP_FROM"] . "</p>";
            echo "<p><strong>Receiver Name:</strong> " . $row["RECEIVER_NAME"] . "</p>";
            echo "<p><strong>Receiver Phone:</strong> " . $row["RECEIVER_PHONE"] . "</p>";
            echo "<p><strong>Receiver Address:</strong> " . $row["RECEIVER_ADDRESS"] . "</p>";
            echo "<p><strong>Ship To:</strong> " . $row["SHIP_TO"] . "</p>";
            echo "<p><strong>Shipment Weight:</strong> " . $row["SHIPMENT_WEIGHT"] . " kg</p>";
            echo "<p><strong>Total Price:</strong> RM " . $row["TOTAL_PRICE"] . "</p>";

            // Add button for payment
            echo '<form action="payment.php" method="post">';
            echo '<input type="hidden" name="shipment_id" value="' . $shipment_id . '">';
            echo '<input type="submit" value="Proceed to Payment">';
            echo '</form>';
        } else {
            echo "Error: Unable to fetch shipment details.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
