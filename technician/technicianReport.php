<?php
require_once __DIR__ . '/../data/db.php';

// Fetch customers
$customerQuery = $db->query('SELECT customerID, firstname, lastname FROM customers ORDER BY customerID');
$customers = $customerQuery->fetchAll();

// Fetch products
$productQuery = $db->query('SELECT productCode, name FROM product ORDER BY name');
$products = $productQuery->fetchAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_POST['customer'];
    $productCode = $_POST['product'];
    $date = $_POST['report_date'];
    $time = $_POST['report_time'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Example: Save to reports table (you must have this table in DB)
    /*
    $stmt = $db->prepare('INSERT INTO technician_reports (customerID, productCode, report_date, report_time, title, description) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$customerID, $productCode, $date, $time, $title, $description]);
    */

    echo "<p style='color: green;'>Report submitted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technician Report</title>
</head>
<body>

    <div class="page-content">
        <h1>Submit Technician Report</h1>
        <a href="../index.php"><strong>Home</strong></a><br><br>
        <form method="post">
            <!-- Customer Dropdown -->
            <label for="customer">Customer:</label><br>
            <select name="customer" id="customer" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $cust): ?>
                    <option value="<?= $cust['customerID'] ?>">
                        <?= $cust['customerID'] . ' - ' . htmlspecialchars($cust['firstname']) . ' ' . htmlspecialchars($cust['lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <!-- Product Dropdown -->
            <label for="product">Product:</label><br>
            <select name="product" id="product" required>
                <option value="">-- Select Product --</option>
                <?php foreach ($products as $prod): ?>
                    <option value="<?= $prod['productCode'] ?>">
                        <?= $prod['productCode'] . ' - ' . htmlspecialchars($prod['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <!-- Date -->
            <label for="report_date">Date:</label><br>
            <input type="date" name="report_date" id="report_date" required><br><br>

            <!-- Time -->
            <label for="report_time">Time:</label><br>
            <input type="time" name="report_time" id="report_time" required><br><br>

            <!-- Title -->
            <label for="title">Report Title:</label><br>
            <input type="text" name="title" id="title" required><br><br>

            <!-- Description -->
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" rows="5" cols="40" required></textarea><br><br>

            <!-- Submit Button -->
            <button type="submit"><strong>Submit Report</strong></button>
        </form>
    </div>
</body>
</html>
