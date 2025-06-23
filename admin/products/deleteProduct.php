<?php

require_once __DIR__ . '/../../data/db.php';


$code = $_GET['productCode'];

$stmt = $db->prepare('DELETE FROM product WHERE productCode = ?');
$stmt->execute([$code]);

header('Location: productManager.php');
exit();
?>
