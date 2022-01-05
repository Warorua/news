<?php
$word = $_POST['search'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "q=".$word."&target=uk",
	CURLOPT_HTTPHEADER => [
		"accept-encoding: application/gzip",
		"content-type: application/x-www-form-urlencoded",
		"x-rapidapi-host: google-translate1.p.rapidapi.com",
		"x-rapidapi-key: 8a6dfaf4camsh19d98d508ec1e8bp1a0efdjsnff40d5953968"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error from Translation Engine #:" . $err;
} else {
	//echo $response;
  $data2 = json_decode($response, TRUE);
  $q1 = $data2['data']['translations'][0]['translatedText'];
}

$search = $q1;


 //$search= $_POST['search'];
 if(isset($_POST['total'])){
   $total = $_POST['total'];
 }
 else{
   $total = 25;
 }
$curl = curl_init();
$output = '';
curl_setopt_array($curl, [
	CURLOPT_URL => "https://free-news.p.rapidapi.com/v1/search?q=".$search."&page_size=".$total."&lang=uk",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: free-news.p.rapidapi.com",
		"x-rapidapi-key: 6c54f8cbdbmsh026aa3e5aecec5dp1a306fjsn99e3c76d8d56"
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
    if($data['status']=="No matches for your search."){
      $output .= '
      <div class="gy-5">
   <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
  No matches for your search.
  </div>
</div>
</div>
      ';
    }
    else{
    $size = sizeof($data['articles'])-1;
    
    for ($x = 0; $x <= $size; $x++) {
        
        $output .=  '
        <div class="col-md-4 gy-5">
<div class="card" style="width: 18rem;">
  <img src="'.$data['articles'][$x]['media'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][$x]['title'].'</h5>
    <p class="card-text">
    '.$data['articles'][$x]['summary'].'
    </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Author : '.$data['articles'][$x]['author'].'</li>
    <li class="list-group-item">Topic : '.$data['articles'][$x]['topic'].'</li>
    <li class="list-group-item">Source : '.$data['articles'][$x]['rights'].'</li>
    <li class="list-group-item">Country : '.$data['articles'][$x]['country'].'</li>
    <li class="list-group-item">Date Published : '.$data['articles'][$x]['published_date'].'</li>
  </ul>
  <div class="card-body">
  <a href="'.$data['articles'][$x]['link'].'" class="card-link">News link</a>
  
  </div>
</div>
</div>
        ';
      }
    }
      echo 
      '
      <div class="row">
      '.$output.'
      </div>
      ';
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
include 'includes/session.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
$stmt->execute();
$data = $stmt->fetchAll();
foreach($data as $row){
  $output .=  '
  <div class="col-md-4">
<div class="card" style="width: 18rem;">
<img src="https://rapidapi.com/cdn/images?url=https://rapidapi-prod-apis.s3.amazonaws.com/2b44cba5-271d-4633-a34b-339c12575abd.png" class="card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">'.$row['name'].' ('.$row['id'].')</h5>
<p class="card-text">
'.$row['date_view'].'
</p>
</div>
<ul class="list-group list-group-flush">
<li class="list-group-item">Email : '.$row['supp_email'].'</li>
<li class="list-group-item">Slug Code : '.$row['slug'].'</li>
<li class="list-group-item">Price : '.$row['price'].'</li>
<li class="list-group-item">Photo : '.$row['photo'].'</li>

</ul>
<div class="card-body">
<a href="" class="card-link">'.$row['brand'].'</a>

</div>
</div>
</div>
  ';

  echo 
  '
  <div class="row">
  '.$output.'
  </div>
  ';
  ;
}
*/