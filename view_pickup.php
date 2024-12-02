<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cargo Pickups</title>
</head>
<body>
    <h2>View Cargo Pickups</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Pickup ID</th>
                <th>Sender Name</th>
                <th>Sender Phone</th>
                <th>Sender Address</th>
                <th>Pickup Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'shippingcon.php'; // Include your database connection file

            $sql = "SELECT * FROM CARGO_PICKUP";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['PICKUP_ID'] . "</td>";
                    echo "<td>" . $row['SENDER_NAME'] . "</td>";
                    echo "<td>" . $row['SENDER_PHONE'] . "</td>";
                    echo "<td>" . $row['SENDER_ADDRESS'] . "</td>";
                    echo "<td>" . $row['PICKUP_DATE'] . "</td>";
                    echo "<td>" . $row['STATUS'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No cargo pickups found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
