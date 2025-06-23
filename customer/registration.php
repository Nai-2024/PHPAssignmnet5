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
    $productCode = $_POST['model'];
    $regDate = $_POST['reg_date'];
    
    echo "<p style='color: green;'>Product registered successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Product</title>
</head>
<body>
    <div class="page-content">
        <h1>Register Product</h1>
        <a href="../index.php"><strong>Home</strong></a><br><br>
        <form method="post">
            <!-- Customer ID Dropdown -->
            <label for="customer">Customer ID:</label><br>
            <select name="customer" id="customer" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $cust): ?>
                    <option value="<?= $cust['customerID'] ?>">
                        <?= $cust['customerID'] . ' - ' . htmlspecialchars($cust['firstname']) . ' ' . htmlspecialchars($cust['lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <!-- Product Model Dropdown -->
            <label for="model">Product Model (Code):</label><br>
            <select name="model" id="model" required>
                <option value="">-- Select Product --</option>
                <?php foreach ($products as $prod): ?>
                    <option value="<?= $prod['productCode'] ?>">
                        <?= $prod['productCode'] . ' - ' . htmlspecialchars($prod['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <!-- Registration Date -->
            <label for="reg_date">Registration Date:</label><br>
            <input type="date" name="reg_date" id="reg_date" required><br><br>

            <button type="submit"><strong>Submit</strong>
        </button>
        </form>
    </div>
</body>
</html>
