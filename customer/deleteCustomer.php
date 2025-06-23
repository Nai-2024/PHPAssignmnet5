<?php

// Database connection file
require_once __DIR__ . '/../data/db.php';

// Get the customer ID from the URL query string 
$customerID = $_GET['customerID'];

// Prepare the SQL DELETE statement to remove the customer with the given ID
$stmt = $db->prepare('DELETE FROM customers WHERE customerID = ?');

// Execute the DELETE statement, passing in the customer ID as a parameter
$stmt->execute([$customerID]);

// Redirect the user back to the main customer Manager list page after deletion
header('Location: customerManager.php');
exit();

?>
