<?php

// Database connection
require_once __DIR__ . '/../../data/db.php';


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values from POST request
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Prepare SQL INSERT query using placeholders to prevent SQL injection
    $sql = 'INSERT INTO technicians (firstname, lastname, email, password, phone) VALUES (?, ?, ?, ?, ?)';

    // Prepare the statement
    $stmt = $db->prepare($sql);

    // Execute the statement with form data
    $stmt->execute([$firstName, $lastName, $email, $password, $phone]);

    // Redirect to the technician list page after insertion
    header('Location: technicianManager.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Technician</title>
     <!-- Link to external CSS file for styling -->
     <link rel="stylesheet" href="../../main.css">
</head>

<body>
    <div class="page-content">

    <!-- Page heading -->
        <h1>Add Technician</h1>

        <!-- Home -->
        <a href="../../index.php"><strong>Home</strong></a><br><br>

        <!-- Technician form -->
        <form method="post">
            <!-- First Name field -->
            <label>First Name:</label>
            <input type="text" name="firstname" required>

            <!-- Last Name field -->
            <label>Last Name:</label>
            <input type="text" name="lastname" required>

            <!-- Email field -->
            <label>Email:</label>
            <input type="text" name="email" required>

            <!-- Password field -->
            <label>Password:</label>
            <input type="text" name="password" required>

            <!-- Phone field -->
            <label>Phone:</label>
            <input type="text" name="phone" required>

            <!-- Submit button -->
            <button type="submit">Add</button>
        </form><br>

        <!-- Link back to the list of technicians -->
        <a href="technicianManager.php"><strong>Back to Products</strong></a>
    </div>
</body>

</html>