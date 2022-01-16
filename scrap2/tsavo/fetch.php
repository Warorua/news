<?php
include 'includes/session.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM products WHERE method=:method");
$stmt->execute(['method'=>'Scrap']);
$data = $stmt->fetchAll();
foreach($data as $row){
$output .= '
<tr>
    <th>'.$row['name'].'</th>
    <td>'.$row['price'].'</td>
    <td>'.$row['slug'].'</td>
    <td>'.$row['supplier'].'</td>
    <td>'.$row['category'].'</td>
  </tr>
';
}
echo $output;
?>