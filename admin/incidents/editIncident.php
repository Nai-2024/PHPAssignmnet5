<?php
// Database connection
require_once __DIR__ . '/../../data/db.php';

// Get incident ID from query string
$incidentID = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : null;
$incident = null;      // Placeholder for the incident to be edited
$incidents = [];       // Array to hold all incidents for display

// If the form is submitted, update the incident
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $customerID = $_POST['customerID'];
  $productCode = $_POST['productCode'];
  $techID = $_POST['techID'];
  $dateOpened = $_POST['dateOpened'];
  $dateClosed = $_POST['dateClosed'];
  $title = $_POST['title'];
  $description = $_POST['description'];

    // SQL statement to update the existing incident
  $sql = 'UPDATE incidents 
            SET customerID = ?, productCode = ?, techID = ?, title = ?, dateOpened = ?, dateClosed = ?, description = ?
            WHERE incidentID = ?';

  // Prepare and execute the update
  $stmt = $db->prepare($sql);
  $stmt->execute([$customerID, $productCode, $techID, $title, $dateOpened, $dateClosed, $description, $incidentID]);

  // Redirect to the same page without the ID to clear the form
  header("Location: incidentManager.php");

}

// --------- FETCH THE INCIDENT TO EDIT ----------
$incident = null; // Reset just in case
if ($incidentID) {
  // Prepare a SELECT query to fetch the specific incident
  $stmt = $db->prepare('SELECT * FROM incidents WHERE incidentID = ?');
  $stmt->execute([$incidentID]);
  $incident = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no incident found with given ID, stop execution with error message
  if (!$incident) {
    die("Incident not found.");
  }

}


// Fetch all incidents to show in the list
$stmt = $db->query('SELECT * FROM incidents ORDER BY incidentID DESC');
$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Incident</title>
  <link rel="stylesheet" href="../../main.css">
</head>

<body>
  <div class="page-content">
    <h1>Edit Incident</h1>
    <!-- Navigation link back to addIncident page -->
    <a href="incidentManager.php"><strong>Back to Incident Manager</strong></a>
    <br><br>

    <div class="center-wrapper">
      <!-- Edit Form -->
      <form method="post">
        <label>Customer ID:</label>
        <input type="text" name="customerID" value="<?= $incident ? htmlspecialchars($incident['customerID']) : '' ?>" required>

        <label>Product Code:</label>
        <input type="text" name="productCode" value="<?= $incident ? htmlspecialchars($incident['productCode']) : '' ?>" required>

        <label>Tech ID:</label>
        <input type="text" name="techID" value="<?= $incident ? htmlspecialchars($incident['techID']) : '' ?>" required>

        <label>Date Opened:</label>
        <input type="date" name="dateOpened" value="<?= $incident ? htmlspecialchars(date('Y-m-d', strtotime($incident['dateOpened']))) : '' ?>" required>

        <label>Date Closed:</label>
        <input type="date" name="dateClosed" value="<?= $incident ? htmlspecialchars(date('Y-m-d', strtotime($incident['dateClosed']))) : '' ?>" required>

        <label>Title:</label>
        <input type="text" name="title" value="<?= $incident ? htmlspecialchars($incident['title']) : '' ?>" required>

        <label>Description:</label>
        <textarea name="description" rows="5" required><?= $incident ? htmlspecialchars($incident['description']) : '' ?></textarea>
        <br>

        <button type="submit">Update</button>
      </form>

      <!-- --------- INCIDENTS LIST DISPLAY --------- -->
      <?php if (!empty($incidents)): ?>
        <br>
        <hr><br>
        <h2>Incidents Record</h2>
        <table border="1" cellpadding="10" style="text-align: center;">
          <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Product Code</th>
            <th>Tech ID</th>
            <th>Date Opened</th>
            <th>Date Closed</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
          <?php foreach ($incidents as $i): ?>
            <tr>
              <td><?= htmlspecialchars($i['incidentID']) ?></td>
              <td><?= htmlspecialchars($i['customerID']) ?></td>
              <td><?= htmlspecialchars($i['productCode']) ?></td>
              <td><?= htmlspecialchars($i['techID']) ?></td>
              <td><?= htmlspecialchars($i['dateOpened']) ?></td>
              <td><?= htmlspecialchars($i['dateClosed']) ?></td>
              <td><?= htmlspecialchars($i['title']) ?></td>
              <td><?= nl2br(htmlspecialchars($i['description'])) ?></td>
              <td>
                <a href="editIncident.php?id=<?= $i['incidentID'] ?>">Edit</a> |
                <a href="deleteIncident.php?id=<?= $i['incidentID'] ?>" onclick="return confirm('Are you sure you want to delete this incident?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
