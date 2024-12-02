<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
	
</head>
<body>
    <h2>Admin Orders</h2>
    <a href="add_pickup.php">Add New Pickup</a> <!-- Link to add_pickup.php -->
    <a href="view_pickup.php">View All Pickups</a> <!-- Link to view_pickups.php -->
    <form action="admin_orders_action.php" method="post">
        <table border="1">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Shipment ID</th>
                    <th>Sender Name</th>
                    <th>Receiver Name</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and display shipment details from the SHIPMENTS table -->
                <?php
                include 'shippingcon.php'; // Include your database connection file
                
                $sql = "SELECT SHIPMENTS.*, PAYMENT.PAYMENT_STATUS
                        FROM SHIPMENTS
                        LEFT JOIN PAYMENT ON SHIPMENTS.SHIPMENT_ID = PAYMENT.SHIPMENT_ID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='selected_shipments[]' value='" . $row['SHIPMENT_ID'] . "'></td>";
                        echo "<td>" . $row['SHIPMENT_ID'] . "</td>";
                        echo "<td>" . $row['SENDER_NAME'] . "</td>";
                        echo "<td>" . $row['RECEIVER_NAME'] . "</td>";
                        echo "<td>" . $row['PAYMENT_STATUS'] . "</td>";
                        echo "<td><a href='edit_shipment.php?shipment_id=" . $row['SHIPMENT_ID'] . "'>Edit</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No shipments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <input type="submit" name="delete_shipments" value="Delete Selected Shipments">
        <input type="submit" name="update_payment_status" value="Update Payment Status">
    </form>
	
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipping Information</title>
</head>
<body>
    <h2>Edit Shipping Information</h2>
    <?php
    include 'shippingcon.php'; // Include database connection file

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $shipment_id = $_POST['shipment_id'];
        $cargo_warehouse_name = $_POST['cargo_warehouse_name'];

        // Update the cargo warehouse name for the shipment
        $sql = "UPDATE CARGO_PICKUP SET CARGO_WAREHOUSE_NAME = '$cargo_warehouse_name' WHERE PICKUP_ID = '$shipment_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Shipping information updated successfully.";
        } else {
            echo "Error updating shipping information: " . $conn->error;
        }
    }

    // Query to fetch cargo warehouse names
    $cargoWarehouses = array("Warehouse A", "Warehouse B", "Warehouse C"); // Sample warehouse names

    // Form to select warehouse and update shipping information
    echo '<form action="" method="post">';
    echo '<label for="shipment_id">Select Shipment ID:</label>';
    echo '<input type="text" name="shipment_id" required><br>';
    echo '<label for="cargo_warehouse_name">Select Cargo Warehouse:</label>';
    echo '<select name="cargo_warehouse_name" required>';
    foreach ($cargoWarehouses as $warehouse) {
        echo '<option value="' . $warehouse . '">' . $warehouse . '</option>';
    }
    echo '</select><br>';
    echo '<input type="submit" value="Update Shipping Information">';
    echo '</form>';

    $conn->close(); // Close database connection
    ?>
</body>
</html>