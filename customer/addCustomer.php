<?php

// Database connection
require_once __DIR__ . '/../data/db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form values from POST request
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

  // Prepare SQL INSERT query using placeholders to prevent SQL injection
  $sql = 'INSERT INTO customers (firstname, lastname, email, password, phone, address, city, state, postalcode, countrycode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';



  // Prepare the statement
  $stmt = $db->prepare($sql);

  // Execute the statement with form data
  $stmt->execute([$firstName, $lastName, $email, $password, $phone, $address, $city, $state, $postalCode, $countryCode]);

  // Redirect to the technician list page after insertion
  header('Location: customerManager.php');
  exit();
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
    <!-- Link to external CSS file for styling -->
    <link rel="stylesheet" href="../main.css">

  </head>

  <body>

    <div class="page-content">
    <!-- Page heading -->
    <h1>Add Customer</h1>

    <!-- Home -->
    <a href="../index.php"><strong>Home</strong></a><br><br>

    <!-- Technician form -->
    <form method="post">
    <label>First Name:</label>
    <input type="text" name="firstname" required>

    <label>Last Name:</label>
    <input type="text" name="lastname" required>

    <label>Email:</label>
    <input type="text" name="email" required>

    <label>Password:</label>
    <input type="text" name="password" required>

    <label>Phone Number:</label>
    <input type="text" name="phone" required>

    <label>Address:</label>
    <input type="text" name="address" required>

    <label>City:</label>
    <input type="text" name="city" required>

    <label>State:</label> <!-- Just once -->
    <input type="text" name="state" required>

    <label>Postal Code:</label> <!-- Fix name -->
    <input type="text" name="postalcode" required>

    <label>Country Code:</label>
    <input type="text" name="countrycode" required>

    <button type="submit">Add Customer</button>
  </form><br>

    <!-- Link back to the list of customer manager -->
    <a href="customerManager.php"><strong>Back to Customer Manager</strong></a>
  </div>
  </body>

  </html>