<?php
include 'includes/session.php';
$conn = $pdo->open();
if(!isset($_GET['id'])){
    $_SESSION['error'] = "Your request could not be processed!";
    header("location: dash.php");
}
else{
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news WHERE id=:id");
$stmt->execute(['id'=>$_GET['id']]);
$auth = $stmt->fetch();
if($auth['numrows'] < 1){
    $_SESSION['error'] = "Article ID error! ID not found!";
    header("location: dash.php");
}
else{
 //delete previous photo
$pic_del = '../images/'.$auth['photo'];
unlink($pic_del);
 //Delete article
$stmt = $conn->prepare("DELETE FROM news WHERE id=:id");
$stmt->execute(['id'=>$_GET['id']]);
$_SESSION['success'] = "Article deleted successfully!";
header("location: dash.php");
}
}

?>