<?php
include 'includes/conn.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news");
$stmt->execute();
$data = $stmt->fetchAll();
foreach($data as $row){
    $output .= '
    <tr>
    <th>'.$row['code'].'</th>
    <td>'.$row['title'].'</td>
    <td>'.$row['source'].'</td>
    <td>'.$row['category'].'</td>
    <td>'.$row['time'].'</td>
  </tr>
 
    ';
}
 echo $output;

?>