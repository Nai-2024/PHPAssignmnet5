<?php
// Database connection
require_once __DIR__ . '/../../data/db.php';


// Get the technician ID from the query string
$techID = $_GET['techID'];

// If no technician ID is provided, stop the script and show an error message
if (!$techID) {
    echo "Technician ID not provided.";
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated technician info from the POST data
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Prepare the SQL UPDATE statement
    $sql = 'UPDATE technicians SET firstname = ?, lastname = ?, email = ?, password = ?, phone = ? WHERE techID = ?';

    // Execute the statement with the user-provided data
    $stmt = $db->prepare($sql);
    $stmt->execute([$firstName, $lastName, $email, $password, $phone, $techID]);

    // Redirect back to the technician list page after update

    header('Location: technicianManager.php');
    exit();
}

// Fetch the existing technician details from the database
$stmt = $db->prepare('SELECT * FROM technicians WHERE techID = ?');
$stmt->execute([$techID]);
$technician = $stmt->fetch();

// If the technician does not exist, show an error message and exit
if (!$technician) {
    echo "Technician not found.";
    exit();
}
?>

<!-- HTML Form to Edit Technician Details -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Technician</title>
    <link rel="stylesheet" href="../../main.css">
</head>

<body>
    <div class="page-content">

        <h1>Edit Technician</h1>
        <!-- Home -->
        <a href="../../index.php"><strong>Home</strong></a><br><br>

        <form method="post">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($technician['firstname']) ?>"
                required>

            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($technician['lastname']) ?>"
                required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($technician['email']) ?>" required>

            <label for="password">Password</label>
            <input type="text" id="password" name="password" value="<?= htmlspecialchars($technician['password']) ?>"
                required>

            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($technician['phone']) ?>" required>

            <button type="submit">Update</button>
        </form>
        <!-- Link to go back to the technician list -->
        <a href="technicianManager.php"><strong>Back to Technicians</strong></a>
    </div>
</body>

</html>