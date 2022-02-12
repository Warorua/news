<?php
include 'includes/session.php';
$conn = $pdo->open();
if(!isset($_GET['id'])){
    $_SESSION['error'] = "Link error!";
    header('location: dash.php');
}
else{
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news WHERE code=:code");
$stmt->execute(['code'=>$_GET['id']]);
$cnt = $stmt->fetch();
$auth = $cnt['numrows'];
if($auth < 1){
    $_SESSION['error'] = "Article error or not found!";
    header('location: dash.php');
}
else{
    $code = $_GET['id'];
}
}

$stmt = $conn->prepare("SELECT * FROM news WHERE code=:code");
$stmt->execute(['code'=>$code]);
$data = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>UkrZmi</title>
  </head>
  <body>
    <div class="container">
        <div class="jumbotron bg-light"><h6 class="text-primary display-6"><?php echo $data['title'] ?></h6></div>
        <div class="row">
            <div class="col-md-4">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Source</th>
      <td><?php echo $data['source'] ?></td>
     </tr>

     <tr>
      <th scope="row">Category</th>
      <td><?php echo $data['category'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Publisher time</th>
      <td><?php echo $data['published'] ?></td>
     </tr>
  </tbody>
</table>
            </div>
            <div class="col-md-4">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Author</th>
      <td><?php echo $data['author'] ?></td>
     </tr>

     <tr>
      <th scope="row">Photograher</th>
      <td><?php echo $data['p_grapher'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Image</th>
      <td><?php echo $data['photo'] ?></td>
     </tr>
  </tbody>
</table>       
            </div>
            <div class="col-md-4">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tags</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Tag 1</th>
      <td><?php echo $data['tag_1'] ?></td>
     </tr>

     <tr>
      <th scope="row">Tag 2</th>
      <td><?php echo $data['tag_2'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Tag 3</th>
      <td><?php echo $data['tag_3'] ?></td>
     </tr>
  </tbody>
</table>            
            </div>
        </div>

        <img src="images/<?php echo $data['photo'] ?>" class="img-fluid" alt="...">
<hr/>
<p class="">
  <?php echo $data['article'] ?>
</p>
<hr/>
<?php
if($data['video_url'] != ""){
  echo '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$data['video_url'].'" style="border:none;overflow:hidden" width="560"></iframe>';
}
else{
  echo '<h6 class="display-6">This article has no videos!</h6>';
}
?>
<hr/>
<div class="row">
    <div class="col-md-3"><a class="btn btn-danger" href="<?php echo $data['deep_link'] ?>" role="button">Deep Link</a></div>
    <div class="col-md-3"><h6>Fetched at: <b><?php echo $data['time'] ?></b></h6></div>
    <div class="col-md-3"><a class="btn btn-danger" href="article_delete.php?id=<?php echo $data['id'] ?>" role="button">Delete Article</a></div>
</div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>