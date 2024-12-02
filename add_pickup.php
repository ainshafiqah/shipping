<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cargo Pickup</title>
</head>
<body>
    <h2>Add Cargo Pickup</h2>
    <form action="add_pickup_process.php" method="post">
        <label for="sender_name">Sender Name:</label>
        <input type="text" name="sender_name" required><br>
        <label for="sender_phone">Sender Phone:</label>
        <input type="text" name="sender_phone" required><br>
        <label for="sender_address">Sender Address:</label>
        <textarea name="sender_address" rows="4" required></textarea><br>
        <label for="pickup_date">Pickup Date:</label>
        <input type="date" name="pickup_date" required><br>
        <input type="submit" value="Add Pickup">
    </form>
</body>
</html>

