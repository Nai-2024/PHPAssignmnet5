<?php
require_once __DIR__ . '/../../data/db.php';

$code = $_GET['productCode'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $version = $_POST['version'];
    $releaseDate = $_POST['releaseDate'];

    $sql = 'UPDATE product SET name = ?, version = ?, releaseDate = ? WHERE productCode = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$name, $version, $releaseDate, $code]);

    header('Location: productManager.php');
    exit();
}

// Fetch product data
$stmt = $db->prepare('SELECT * FROM product WHERE productCode = ?');
$stmt->execute([$code]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Product</title>
   <link rel="stylesheet" href="../../main.css">
</head>

<body>
     <div class="page-content">
        <h1>Edit Product</h1>

        <a href="../index.php"><strong>Home</strong></a><br><br>

        <form method="post">
            <label>Code</label>
            <input type="text" name="code" value="<?= htmlspecialchars($product['productCode']) ?>" disabled>

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

            <label for="version">Version</label>
            <input type="text" id="version" name="version" value="<?= htmlspecialchars($product['version']) ?>" required>

            <label for="releaseDate">Release Date</label>
            <input type="date" id="releaseDate" name="releaseDate" value="<?= htmlspecialchars($product['releaseDate']) ?>"
                required>

            <button type="submit">Update</button>
        </form>
        <a href="productManager.php"><strong>Back to Products</strong></a>
    </div>
</body>

</html>