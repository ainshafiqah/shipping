<?php
include 'shippingcon.php'; // Include your database connection file

// Handle deletion of selected shipments
if (isset($_POST['delete_shipments'])) {
    if (!empty($_POST['selected_shipments'])) {
        $selectedShipments = $_POST['selected_shipments'];
        
        // Convert array values to comma-separated string
        $shipmentIds = implode(',', $selectedShipments);
        
        // Delete selected shipments from the database
        $deleteQuery = "DELETE FROM SHIPMENTS WHERE SHIPMENT_ID IN ($shipmentIds)";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Selected shipments deleted successfully.";
        } else {
            echo "Error deleting selected shipments: " . $conn->error;
        }
    } else {
        echo "No shipments selected for deletion.";
    }
}

// Handle updating payment status
if (isset($_POST['update_payment_status'])) {
    if (!empty($_POST['selected_shipments'])) {
        $selectedShipments = $_POST['selected_shipments'];
        
        // Convert array values to comma-separated string
        $shipmentIds = implode(',', $selectedShipments);
        
        // Update payment status in the payment table
        $updatePaymentQuery = "UPDATE PAYMENT SET PAYMENT_STATUS = 'Confirmed' WHERE SHIPMENT_ID IN ($shipmentIds)";
        if ($conn->query($updatePaymentQuery) === TRUE) {
            echo "Payment status updated successfully.";
        } else {
            echo "Error updating payment status: " . $conn->error;
        }
    } else {
        echo "No shipments selected for updating payment status.";
    }
}

$conn->close();
?>
