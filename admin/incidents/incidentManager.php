<?php
// Data base connection 
require_once __DIR__ . '/../../data/db.php';

// FILTER logic (GET)
$filterCustomerID = $_GET['customerID'] ?? '';
$filterProductCode = $_GET['productCode'] ?? '';

// -------- INSERT logic (POST) --------
// If the form is submitted (POST) and techID is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['techID'])) {

   // Retrieve form data from POST request
  $customerID = $_POST['customerID'];
  $productCode = $_POST['productCode'];
  $techID = $_POST['techID'];
  $dateOpened = $_POST['dateOpened'];
  $dateClosed = $_POST['dateClosed'];
  $title = $_POST['title'];
  $description = $_POST['description'];

    // SQL query to insert a new incident into the database
  $sql = 'INSERT INTO incidents (customerID, productCode, techID, title, dateOpened, dateClosed, description)
          VALUES (?, ?, ?, ?, ?, ?, ?)';
  $stmt = $db->prepare($sql);
  $stmt->execute([$customerID, $productCode, $techID, $title, $dateOpened, $dateClosed, $description]);
}
// -------- FETCH logic with optional filters --------
// Start building the SQL query to select incidents
$sql = 'SELECT * FROM incidents WHERE 1=1';  // // Always true, allows dynamic filters to be appended
$params = [];

// Apply customer ID filter if provided
if (!empty($filterCustomerID)) {
  $sql .= ' AND customerID = ?';
  $params[] = $filterCustomerID;
}

// Apply product code filter if provided
if (!empty($filterProductCode)) {
  $sql .= ' AND productCode = ?';
  $params[] = $filterProductCode;
}

// Sort the results by most recent incident first
$sql .= ' ORDER BY incidentID DESC';
// Prepare and execute the SQL query
$stmt = $db->prepare($sql);
$stmt->execute($params);
// Fetch all matching incidents as an associative array
$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Incident</title>
 <link rel="stylesheet" href="../../main.css">
</head>

<body>
    <div class="page-content">
      <h1> Incident Manager (Admin)</h1>
          <!-- Link back to homepage -->
      <a href="../../index.php"><strong>Home</strong></a>
        
        <!-- -------- Filter Form -------- -->
      <div class="filter-container">
        <form method="get" class="filter-form">
          <div class="inputs-column">
            <label for="customerID">Filter: Customer ID</label>
            <input type="text" id="customerID" name="customerID" value="<?= htmlspecialchars($filterCustomerID) ?>">

            <label for="productCode">Product Code:</label>
            <input type="text" id="productCode" name="productCode" value="<?= htmlspecialchars($filterProductCode) ?>">
          </div>
        <!-- Submit button to apply filters && clear link -->
          <div class="actions-row">
            <button type="submit">Search</button>
            <a href="incidentManager.php" id="clearSearch">Clear</a>
          </div>
        </form>
      </div>

        <br><br>

            <!-- Incident Form Section-->
        <div class="center-wrapper">
          <div class="form-container">
            <h1>Add New Incident</h1>
            <form method="post">
              <label>Customer ID:</label>
              <input type="text" name="customerID" required>

              <label>Product Code:</label>
              <input type="text" name="productCode" required>

              <label>Tech ID:</label>
              <input type="text" name="techID" required>
              <label>Date Opened:</label>
              <input type="date" name="dateOpened" required>

              <label>Date Closed:</label>
              <input type="date" name="dateClosed" required>


              <label>Title:</label>
              <input type="text" name="title" required>

              <label>Description:</label>
              <textarea name="description" rows="5" required></textarea> <br>

              <button type="submit">Add</button>
            </form>
          </div>

          <!-- Show inserted incident -->
          <?php if (!empty($incidents)): ?>
            <br>
            <hr><br>
            <h2>Incidents Record</h2>
            <table border="1" cellpadding="10" style="text-align: center;">
                <!-- Table headings -->
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

                <!-- Loop through each incident and display in table -->
              <?php foreach ($incidents as $incident): ?>
                <tr>
                  <td><?= htmlspecialchars($incident['incidentID']) ?></td>
                  <td><?= htmlspecialchars($incident['customerID']) ?></td>
                  <td><?= htmlspecialchars($incident['productCode']) ?></td>
                  <td><?= htmlspecialchars($incident['techID']) ?></td>
                  <td><?= htmlspecialchars($incident['dateOpened']) ?></td>
                  <td><?= htmlspecialchars($incident['dateClosed']) ?></td>
                  <td><?= htmlspecialchars($incident['title']) ?></td>
                  <td><?= nl2br(htmlspecialchars($incident['description'])) ?></td>
                  
                  <!-- Action links to edit or delete the incident -->
                  <td>
                    <a href="editIncident.php?id=<?= $incident['incidentID'] ?>">Edit</a> |
                    <a href="deleteIncident.php?id=<?= $incident['incidentID'] ?>"
                      onclick="return confirm('Are you sure you want to delete this incident?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          <?php endif; ?>
        </div>
        <br>
    </div>
</body>

</html>