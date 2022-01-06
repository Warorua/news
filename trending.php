<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://google-news.p.rapidapi.com/v1/top_headlines?lang=uk&country=ua",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: google-news.p.rapidapi.com",
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
    $size = sizeof($data['articles'])-1;
    $output = '';
    for ($x = 0; $x <= $size; $x++) {
    $output .= 
    '
    <div class="col-md-6 gy-5">
    <div class="card text-center">
  <div class="card-header">
    '.$data['articles'][$x]['source']['title'].'
  </div>
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][$x]['source']['title'].'</h5>
    <p class="card-text">'.$data['articles'][$x]['title'].'</p>
    <a href="single_trending.php?q='.$data['articles'][$x]['link'].'&source='.$data['articles'][$x]['source']['href'].'" target="_blank" class="btn btn-primary">Read More</a>
    <a href="'.$data['articles'][$x]['link'].'" target="_blank">original Link</a>
  </div>
  <div class="card-footer text-muted">
  '.$data['articles'][$x]['published'].'
  </div>
</div>
</div>
    ';
    }
    echo 
    '
    <div class="row">
    '.$output.'
    </div>
    ';
}