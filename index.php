<?php
session_start();
/*$_SESSION['role'] = 'admin'; */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="welcome">
        <h1>Welcome to SportsPro Technical Support</h1>
    </div>

        <div class="container">

            <!-- Move login div inside container -->
            <div class="login">
                <h1>Login</h1>
                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <button type="submit">Login</button>
                </form>
            </div>

            <!-- Sections -->
            <div class="section-row">
                <div class="administrator">
                
                    <h1>Administrator</h1>
                    <hr>
                    <a href="admin/login.php">Admin Login</a><br>
                    <a href="admin/products/productManager.php">Product Manager</a><br>
                    <a href="admin/tech/technicianManager.php">Technician Manager</a><br>
                    <a href="admin/incidents/incidentManager.php">Incidents Manager</a><br>
                
                </div>

                <div class="customer">
                    <h1>Customer</h1>
                    <hr>
                    <a href="customer/login.php">Customer Login</a><br>
                    <a href="customer/customerManager.php">Customer Manager</a><br>
                    <a href="customer/registration.php">Registration</a>
                </div>

                <div class="technician">
                    <h1>Technician</h1>
                    <hr>
                    <a href="technician/login.php">Technician Login</a><br>
                    <a href="technician/technicianReport.php">Technician Report</a>
                </div>
            </div>
        </div>

</body>
</html>
