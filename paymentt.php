<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h2>Payment Form</h2>
    <form action="paymentt_process.php" method="post">
        <input type="hidden" name="shipment_id" value="<?php echo $_POST['shipment_id']; ?>">
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="PayPal">PayPal</option>
            <!-- Add more payment methods as needed -->
        </select><br>
        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" required><br>
        <label for="payment_status">Payment Status:</label>
        <input type="text" name="payment_status" id="payment_status" value="Pending" readonly><br>
        <input type="submit" value="Submit Payment">
    </form>
</body>
</html>
