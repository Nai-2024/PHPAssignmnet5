<?php

require_once __DIR__ . '/../../data/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['productCode'];
    $name = $_POST['name'];
    $version = $_POST['version'];
    $releaseDate = $_POST['releaseDate'];

    $sql = 'INSERT INTO product (productCode, name, version, releaseDate) VALUES (?, ?, ?, ?)';
    $stmt = $db->prepare($sql);
    $stmt->execute([$code, $name, $version, $releaseDate]);

    header('Location: productManager.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <!-- Link to external CSS file for styling -->
    <link rel="stylesheet" href="../../main.css">
</head>

<body>
    <div class="page-content">
        <!-- Page heading -->
        <h1>Add Product</h1>

        <!-- Home link -->
        <a href="../../index.php"><strong>Home</strong></a><br><br>

        <!-- Products form -->
        <form method="post" action="">
            <!-- Product Code -->
            <label for="productCode">Code:</label>
            <input type="text" id="productCode" name="productCode" required><br>

            <!-- Product Name -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <!-- Product Version -->
            <label for="version">Version:</label>
            <input type="text" id="version" name="version" required><br>

            <!-- Product Release Date -->
            <label for="releaseDate">Release Date:</label>
            <input type="date" id="releaseDate" name="releaseDate" required><br><br>

            <!-- Add button -->
            <button type="submit">Add</button>
        </form>

        <br>
        <!-- Back to product list -->
        <a href="productManager.php"><strong>Back to Products</strong></a>
    </div>
</body>

</html>
