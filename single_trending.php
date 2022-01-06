<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
   <?php
include 'includes/navbar.php';
   ?>
  <div class="container">   
  <?php
$item = $_GET['q'];
$source = $_GET['source'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://extract-news.p.rapidapi.com/v0/article?url=".$item,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: extract-news.p.rapidapi.com",
		"x-rapidapi-key: 8a6dfaf4camsh19d98d508ec1e8bp1a0efdjsnff40d5953968"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
    $data = json_decode($response, TRUE);

}
?>
  <div class="row">
      <div class="col">
      <div class="card">
  <h5 class="card-header"><?php echo $data['article']['title'] ?></h5>
  <div class="card-body">
      <?php
      if(isset($data['article']['meta_favicon'])){
          echo '
          <img src="'.$data['article']['meta_favicon'].'" width="64px" />
          ';
      }
      else{
         echo '
         <img src="https://rapidapi.com/cdn/images?url=https://rapidapi-prod-apis.s3.amazonaws.com/2b44cba5-271d-4633-a34b-339c12575abd.png" width="64px" />
         '; 
      }
      ?>
    <h5 class="card-title"><?php echo $data['article']['title'] ?></h5>
    <p class="card-text">
        <img src="<?php echo $data['article']['top_image'] ?>" width="100%" />
        <?php echo $data['article']['text'] ?>
        <div class="row">
           <?php
 $size = sizeof($data['article']['images'])-1;
 if($size == 1){
     $frame = 'col-md-12';
 }
 elseif($size == 2){
    $frame = 'col-md-6';
 }
 elseif($size == 3){
    $frame = 'col-md-4';
}
elseif($size >= 4){
    $frame = 'col-md-3'; 
}
 for ($x = 0; $x <= $size; $x++) {
echo '
<div class="'.$frame.'">
<img src="'.$data['article']['images'][$x].'" width="100%" />
</div>
';
 }
?> 
        </div>

    </p>
  
  </div>
<div class="card-footer text-muted">
    <div class="row">
    <div class="col-md-6">
<h5 class="text-primary">Author:  <?php echo $data['article']['authors'][0] ?></h5>
</div>
<div class="col-md-6">
<h5 class="text-primary"> Source: <?php echo $source ?></h5>
</div>
<div class="col-md-12">
<?php echo $data['article']['published'] ?>
</div>
</div>
  </div>







</div>
      </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
  </body>
</html>