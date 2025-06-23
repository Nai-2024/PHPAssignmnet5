<?php

// Database connection file
require_once __DIR__ . '/../../data/db.php';


// Get the technician ID from the URL query string 
$techID = $_GET['techID'];

// Prepare the SQL DELETE statement to remove the technician with the given ID
$stmt = $db->prepare('DELETE FROM technicians WHERE techID = ?');

// Execute the DELETE statement, passing in the technician ID as a parameter
$stmt->execute([$techID]);

// Redirect the user back to the main technician list page after deletion
header('Location: technicianManager.php');
exit();

?>
