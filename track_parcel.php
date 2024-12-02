<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Parcel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px; /* Add padding for better spacing */
        }
        h2 {
            color: #795548; /* Brown color for headings */
            text-align: center;
        }
        form {
            margin-bottom: 20px; /* Add margin at the bottom of the form */
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #795548;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #5d4037; /* Darker brown on hover */
        }
        .parcel-info {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }
        .parcel-info h3 {
            color: #795548;
            margin-top: 0;
        }
        .parcel-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Track Your Parcel</h2>
    <form action="track_parcel.php" method="post">
        <label for="tracking_number">Enter Tracking Number:</label>
        <input type="text" name="tracking_number" required>
        <input type="submit" value="Track">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $trackingNumber = $_POST['tracking_number'];

        // Include your database connection file
        include 'shippingcon.php';

        // Query to fetch parcel information based on tracking number
        $sql = "SELECT * FROM CARGO_PICKUP WHERE PICKUP_ID = '$trackingNumber'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Display parcel information
            $row = $result->fetch_assoc();
            echo "<div class='parcel-info'>";
            echo "<h3>Parcel Information</h3>";
            echo "<p><strong>Tracking Number:</strong> " . $row['PICKUP_ID'] . "</p>";
            echo "<p><strong>Sender Name:</strong> " . $row['SENDER_NAME'] . "</p>";
            echo "<p><strong>Sender Phone:</strong> " . $row['SENDER_PHONE'] . "</p>";
            echo "<p><strong>Sender Address:</strong> " . $row['SENDER_ADDRESS'] . "</p>";
            echo "<p><strong>Pickup Date:</strong> " . $row['PICKUP_DATE'] . "</p>";
            echo "<p><strong>Status:</strong> " . $row['STATUS'] . "</p>";
            echo "<p><strong>Cargo Warehouse Name:</strong> " . $row['CARGO_WAREHOUSE_NAME'] . "</p>";
            echo "</div>"; // Close parcel-info div
        } else {
            echo "<p>No parcel found with the provided tracking number.</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>