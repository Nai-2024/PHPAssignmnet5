<?php
require_once __DIR__ . '/../data/db.php';

// Get customerID from query string
$customerID = $_GET['customerID'] ?? null;

if (!$customerID) {
    echo "No customer ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalcode'];
    $countryCode = $_POST['countrycode'];

    // Corrected table name and placeholders
    $sql = 'UPDATE customers 
            SET firstname = ?, lastname = ?, email = ?, password = ?, phone = ?, address = ?, city = ?, state = ?, postalcode = ?, countrycode = ?
            WHERE customerID = ?';

    $stmt = $db->prepare($sql);
    $stmt->execute([$firstName, $lastName, $email, $password, $phone, $address, $city, $state, $postalCode, $countryCode, $customerID]);

    header('Location: customerManager.php');
    exit();
}

// Fetch customer data
$stmt = $db->prepare('SELECT * FROM customers WHERE customerID = ?');
$stmt->execute([$customerID]);
$customer = $stmt->fetch();

if (!$customer) {
    echo "Customer not found.";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Customer</title>
  <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="edit-customer">
        <h1>Edit Customer</h1>

        <a href="../index.php"><strong>Home</strong></a><br><br>

        <form method="post">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($customer['firstname']) ?>" required>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($customer['lastname']) ?>" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?= htmlspecialchars($customer['password']) ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($customer['address']) ?>" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?= htmlspecialchars($customer['city']) ?>" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" value="<?= htmlspecialchars($customer['state']) ?>" required>

            <label for="postalcode">Postal Code:</label>
            <input type="text" id="postalcode" name="postalcode" value="<?= htmlspecialchars($customer['postalCode']) ?>" required>

            <label for="countrycode">Country Code:</label>
            <input type="text" id="countrycode" name="countrycode" value="<?= htmlspecialchars($customer['countryCode']) ?>" required>

            <button type="submit">Update</button>
        </form>
        <a href="customerManager.php"><strong>Back to Customer Manager</strong></a>

    </div>
</body>

</html>