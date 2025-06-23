<?php
require_once __DIR__ . '/../data/db.php';


// Get all products
$query = $db->query('SELECT * FROM customers ORDER BY customerID');
$customers = $query->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Management</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="page-content">
        <h1>Customer Manager</h1>

        <!-- Navigation -->
        <a href="../index.php"><strong>Home</strong></a><br><br>
        <a class="add-cust-link" href="addCustomer.php"><strong>Add New Customer</strong></a>

        <!-- Product Table -->
        <table>
            <thead>
                <tr>  
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Add</th>
                    <th>Password</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postal Code</th>
                    <th>Country Code</th>                
                    <th>Action</th>                

                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['customerID']) ?></td>
                        <td><?= htmlspecialchars($customer['firstname']) ?></td>
                        <td><?= htmlspecialchars($customer['lastname']) ?></td>
                        <td><?= htmlspecialchars($customer['email']) ?></td>
                        <td><?= htmlspecialchars($customer['password']) ?></td>
                        <td><?= htmlspecialchars($customer['phone']) ?></td>
                        <td><?= htmlspecialchars($customer['address']) ?></td>
                        <td><?= htmlspecialchars($customer['city']) ?></td>
                        <td><?= htmlspecialchars($customer['state']) ?></td>
                        <td><?= htmlspecialchars($customer['postalCode']) ?></td>
                        <td><?= htmlspecialchars($customer['countryCode']) ?></td>
                        <td class="actions">
                            <a href="editCustomer.php?customerID=<?= urlencode($customer['customerID']) ?>">Edit</a> |
                            <a href="deleteCustomer.php?customerID=<?= urlencode($customer['customerID']) ?>"
                            onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
