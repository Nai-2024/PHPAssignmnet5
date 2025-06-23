
<?php
// Include the database connection
require_once __DIR__ . '/../../data/db.php';


// Retrieve all technicians from the database
$query = $db->query('SELECT * FROM technicians');
// Fetch the results as an associative array
$technicians = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Tech Management</title>
    <link rel="stylesheet" href="../../main.css">
</head>

<body>
    <div class="tech-manager">
    <!-- Page Title -->
    <h1>Technians</h1>
    
   <!-- Home -->
    <a href="../../index.php"><strong>Home</strong></a><br><br>

    <!-- Link to the Add Technician form -->
    <a class="add-tech-link" href="addTechnician.php"><strong>Add New Technians</strong></a><br><br><br>

    <!-- Table displaying the list of technicians -->
    <table >
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <!-- Loop through each technician and display their information in a table row -->
        <?php foreach ($technicians as $technician): ?>
            <tr>
                <td><?= htmlspecialchars($technician['techID']) ?></td>
                <td><?= htmlspecialchars($technician['firstname']) ?></td>
                <td><?= htmlspecialchars($technician['lastname']) ?></td>
                <td><?= htmlspecialchars($technician['email']) ?></td>
                <td><?= htmlspecialchars($technician['password']) ?></td>
                <td><?= htmlspecialchars($technician['phone']) ?></td>
                <td>
                    <!-- Action links: Edit and Delete (with confirmation dialog for Delete) -->
                    <a href="editTechnician.php?techID=<?= urlencode($technician['techID']) ?>">Edit</a> |
                    <a href="deleteTechnician.php?techID=<?= urlencode($technician['techID']) ?>"
                        onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>

</html>