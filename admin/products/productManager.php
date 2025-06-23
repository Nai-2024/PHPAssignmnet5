<?php

session_start();
require_once __DIR__ . '/../../data/db.php';


// Get all products
$query = $db->query('SELECT * FROM product ORDER BY name');
$products = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
  <link rel="stylesheet" href="../../main.css">
</head>
<body>
    <div class="product-manager">
    <h1>Products List</h1>

    <!-- Navigation -->
      <a href="../../index.php"><strong>Home</strong></a><br><br>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'customer'): ?>
        <a class="add-prod-link" href="addProducts.php"><strong>Add New Product</strong></a>
    <?php endif; ?>

    <!-- Product Table -->
      <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                 <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer'): ?>
                    <th>Actions</th>
                 <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['productCode']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['version']) ?></td>
                    <td><?= htmlspecialchars($product['releaseDate']) ?></td>
                  <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer'): ?>
                    <td class="actions">
                        <a href="editProduct.php?productCode=<?= urlencode($product['productCode']) ?>">Edit</a> |
                        <a href="deleteProduct.php?productCode=<?= urlencode($product['productCode']) ?>"
                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
