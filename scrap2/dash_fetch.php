<?php
include 'includes/conn.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news ORDER by id DESC LIMIT 20");
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
    <td><a class="btn btn-warning" href="article_data.php?id='.$row['code'].'" >Preview</a></td>
  </tr>
 
    ';
}
 echo $output;

?>