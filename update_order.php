<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
</head>
<body>
    <h2>Admin Orders</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Shipment ID</th>
                <th>Order Status</th>
                <th>Tracking Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch and display orders from the database -->
            <?php
            include 'shippingcon.php'; // Include your database connection file
            
            $sql = "SELECT * FROM `ORDER`";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ORDER_ID'] . "</td>";
                    echo "<td>" . $row['SHIPMENT_ID'] . "</td>";
                    echo "<td>" . $row['ORDER_STATUS'] . "</td>";
                    echo "<td>" . $row['TRACKING_NUMBER'] . "</td>";
                    echo "<td><a href='update_order.php?order_id=" . $row['ORDER_ID'] . "'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
