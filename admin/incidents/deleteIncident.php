<?php
// Database connection file
require_once __DIR__ . '/../../data/db.php';


// Get the incident ID from the URL query string
$incidentID = isset($_GET['id']) ? (int)$_GET['id'] : null;

// If a valid ID is provided, delete the incident
if ($incidentID) {
    $stmt = $db->prepare('DELETE FROM incidents WHERE incidentID = ?');
    $stmt->execute([$incidentID]);
}

// Redirect back to the incident page
header('Location: editIncident.php');
exit();
?>
