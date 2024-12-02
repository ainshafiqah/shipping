<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Details</title>
</head>
<body>



            <h2 align='center'>Shipping Details</h2>

            <form action="receipt.php" method="post" oninput="calculateTotalPrice()">
                <h3>Sender Details</h3>
                <label for="sender_name">Full Name:</label>
                <input type="text" name="sender_name" required>
                <label for="sender_phone">Phone Number:</label>
                <input type="text" name="sender_phone" required>
                <label for="sender_address">Address:</label>
                <textarea name="sender_address" rows="4" required></textarea>
                <label for="sender_state">Ship from:</label>
                <select name="sender_state" id="sender_state" required>
                    <option value="Peninsular">Peninsular</option>
                    <option value="Sabah & Sarawak">Sabah & Sarawak</option>
                    <!-- Add more states as needed -->
                </select>

                <h3>Receiver Details</h3>
                <label for="receiver_name">Full Name:</label>
                <input type="text" name="receiver_name" required>
                <label for="receiver_phone">Phone Number:</label>
                <input type="text" name="receiver_phone" required>
                <label for="receiver_address">Address:</label>
                <textarea name="receiver_address" rows="4" required></textarea>
                <label for="receiver_state">Ship to:</label>
                <select name="receiver_state" id="receiver_state" required>
                    <option value="Peninsular">Peninsular</option>
                    <option value="Sabah & Sarawak">Sabah & Sarawak</option>
                    <!-- Add more states as needed -->
                </select>

                <h3>Shipment Weight</h3>
                <label for="shipment_weight">Weight (in kg):</label>
                <input type="number" name="shipment_weight" id="shipment_weight" required>

                <!-- Display the total price on the form -->
                <label for="total_price">Total Price:</label>
                <input type="text" id="total_price" readonly>
                
                <!-- Hidden input to store total price for form submission -->
                <input type="hidden" name="total_price" id="total_price_hidden">

                <input type="submit" value="Submit">
            </form>

            <script>
                // Function to calculate and display total price
                function calculateTotalPrice() {
                    // Get values from the form
                    var senderState = document.getElementById('sender_state').value;
                    var receiverState = document.getElementById('receiver_state').value;
                    var shipmentWeight = parseFloat(document.getElementById('shipment_weight').value);

                    // Define shipping rates
                    var peninsularToPeninsularRate = 7;
                    var peninsularToSabahSarawakRate = 10;
                    var SabahSarawakToSabahSarawakRate = 7;
                    var SabahSarawakToPeninsularRate = 10;
                    
                    // Rate per kilogram
                    var ratePerKilogram = 2.5;

                    // Calculate total price based on conditions
                    var totalPrice = 0;

                    if (senderState === "Peninsular" && receiverState === "Peninsular") {
                        totalPrice = peninsularToPeninsularRate + shipmentWeight * ratePerKilogram;
                    } else if (senderState === "Peninsular" && receiverState === "Sabah & Sarawak") {
                        totalPrice = peninsularToSabahSarawakRate + shipmentWeight * ratePerKilogram;
                    } else if (senderState === "Sabah & Sarawak" && receiverState === "Sabah & Sarawak") {
                        totalPrice = SabahSarawakToSabahSarawakRate + shipmentWeight * ratePerKilogram;
                    } else if (senderState === "Sabah & Sarawak" && receiverState === "Peninsular") {
                        totalPrice = SabahSarawakToPeninsularRate + shipmentWeight * ratePerKilogram;
                    }

                    // Display the total price on the form
                    document.getElementById('total_price').value = totalPrice.toFixed(2);
                    document.getElementById('total_price_hidden').value = totalPrice.toFixed(2);
                }
            </script>
        </div>
    </section>
    <footer>
        
        <a href="loginn.php" class="button">back</a>
    </footer>
</body>
</html>
