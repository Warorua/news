<?php
include 'includes/session.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM products WHERE method=:method");
$stmt->execute(['method'=>"Scrap"]);
foreach($stmt as $row){
    unlink('../../../tsavo/tsavo_vendor/images/'.$row['photo']);
}


$stmt = $conn->prepare("DELETE FROM products WHERE method=:method");
$stmt->execute(['method'=>"Scrap"]);


echo '
<div class="alert alert-primary" role="alert">Delete Operation finished successfully</div>
';
?>