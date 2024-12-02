<?php
// Include database connection
include 'shippingcon.php';

// Assume $shipmentId and other order-related data are obtained from user input or previous steps

// Retrieve shipment details from the SHIPMENTS table
$sql = "SELECT * FROM SHIPMENTS WHERE SHIPMENT_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shipmentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $shipmentData = $result->fetch_assoc();

    // Combine order and shipment details
    $orderData = array(
        'shipment_id' => $shipmentData['SHIPMENT_ID'],
        'order_status' => 'Pending', // Set initial order status
        'tracking_number' => $shipmentData['TRACKING_NUMBER'],
        // Include other order-related data as needed
    );

    // Insert order data into the ORDERS table
    $insertSql = "INSERT INTO ORDERS (SHIPMENT_ID, ORDER_STATUS, TRACKING_NUMBER) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("iss", $orderData['shipment_id'], $orderData['order_status'], $orderData['tracking_number']);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Order placed successfully!";
    } else {
        echo "Failed to place order.";
    }
} else {
    echo "Shipment details not found.";
}

$stmt->close();
$conn->close();
?>
