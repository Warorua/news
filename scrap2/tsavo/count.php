<?php
include 'includes/session.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM products WHERE method=:method");
$stmt->execute(['method'=>"Scrap"]);
$data = $stmt->fetch();


echo '
<div class="alert alert-success" role="alert">Items Fetched: '.$data['numrows'].'</div>
';
?>