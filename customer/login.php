<?php

// DB Connection
require_once __DIR__ . '/../data/db.php';

// Stores user data/input on the server
session_start();

// Initialzing a blank message 
$message = '';

// This check if the user submiited form using post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];  // this stores the user input name/email
    $password = $_POST['password'];  // this stores the user input password

    // This prepares an SQL statement to search for a user in the customers table where the email and password match the user’s input.
    // It selects the customerID, email, and password from the matching row, if found.
    $stmt = $db->prepare('SELECT customerID, email, password FROM customers WHERE email = ? AND password = ?');
    // Now run that query using the actual email and password the user entered.
    $stmt->execute([$username, $password]);
    // If the email and password were found in the database, get that customer’s information and store it in $customer.
    $customer = $stmt->fetch();

    if ($customer) {

        //This code checks if the user's login info matched a record in the database.
        $_SESSION['email'] = $customer['email'];
        $_SESSION['password'] = $customer['password'];
        $_SESSION['role'] = 'customer';  // Setting role for customer

        // Redirect to a dashboard or welcome page
      header('Location: customerManager.php');
        exit();
    } else {
        // No match
        $message = "Invalid credentials. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Customer Login</h1>
    
    <?php if ($message): ?>
        <p style="color: red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Username (Email):</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit"><strong>Login</strong></button>
    </form>
    <p>Don't have an account? Please call 647 - 777 8888 to create an account for you! </p>
</body>
</html>
