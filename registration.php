<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

    <h2>User Registration</h2>
    
    <form action="registration_process.php" method="post">
        Full Name: <input type="text" name="full_name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone Number: <input type="text" name="phone_number" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Register">
    </form>

</body>
</html>
