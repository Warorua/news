<?php
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://newscatcher.p.rapidapi.com/v1/latest_headlines?lang=uk&country=UA&media=True",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: newscatcher.p.rapidapi.com",
		"x-rapidapi-key: 6c54f8cbdbmsh026aa3e5aecec5dp1a306fjsn99e3c76d8d56"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
}else {
	//echo $response;
    $data = json_decode($response, TRUE);

}
?>
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
  <div class="container">    
    <div class="row">
        <?php
       
            echo '




  <div class="col-md-4">
<div class="card" style="width: 18rem;">
  <img src="'.$data['articles'][0]['media'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][0]['title'].'</h5>
    <p class="card-text">
    '.$data['articles'][0]['summary'].'
    </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Source : '.$data['articles'][0]['clean_url'].'</li>
    <li class="list-group-item">Topic : '.$data['articles'][0]['topic'].'</li>
    <li class="list-group-item">Date : '.$data['articles'][0]['published_date'].'</li>
    <li class="list-group-item">Rank : '.$data['articles'][0]['rank'].'</li>
    <li class="list-group-item">Author : '.$data['articles'][0]['author'].'</li>
  </ul>
  <div class="card-body">
  <a href="'.$data['articles'][0]['link'].'" class="card-link">News link</a>
    <a href="#" class="card-link">'.$data['articles'][0]['_id'].'</a>
  </div>
</div>
</div>

<div class="col-md-4">
<div class="card" style="width: 18rem;">
  <img src="'.$data['articles'][1]['media'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][1]['title'].'</h5>
    <p class="card-text">
    '.$data['articles'][1]['summary'].'
    </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Source : '.$data['articles'][1]['clean_url'].'</li>
    <li class="list-group-item">Topic : '.$data['articles'][1]['topic'].'</li>
    <li class="list-group-item">Date : '.$data['articles'][1]['published_date'].'</li>
    <li class="list-group-item">Rank : '.$data['articles'][1]['rank'].'</li>
    <li class="list-group-item">Author : '.$data['articles'][1]['author'].'</li>
  </ul>
  <div class="card-body">
    <a href="'.$data['articles'][1]['link'].'" class="card-link">News link</a>
    <a href="#" class="card-link">'.$data['articles'][1]['_id'].'</a>
  </div>
</div>
</div>



<div class="col-md-4">
<div class="card" style="width: 18rem;">
  <img src="'.$data['articles'][2]['media'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][2]['title'].'</h5>
    <p class="card-text">
    '.$data['articles'][2]['summary'].'
    </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Source : '.$data['articles'][2]['clean_url'].'</li>
    <li class="list-group-item">Topic : '.$data['articles'][2]['topic'].'</li>
    <li class="list-group-item">Date : '.$data['articles'][2]['published_date'].'</li>
    <li class="list-group-item">Rank : '.$data['articles'][2]['rank'].'</li>
    <li class="list-group-item">Author : '.$data['articles'][2]['author'].'</li>
  </ul>
  <div class="card-body">
  <a href="'.$data['articles'][2]['link'].'" class="card-link">News link</a>
    <a href="#" class="card-link">'.$data['articles'][2]['_id'].'</a>
  </div>
</div>
</div>


<div class="col-md-4">
<div class="card" style="width: 18rem;">
  <img src="'.$data['articles'][3]['media'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$data['articles'][3]['title'].'</h5>
    <p class="card-text">
    '.$data['articles'][3]['summary'].'
    </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Source : '.$data['articles'][3]['clean_url'].'</li>
    <li class="list-group-item">Topic : '.$data['articles'][3]['topic'].'</li>
    <li class="list-group-item">Date : '.$data['articles'][3]['published_date'].'</li>
    <li class="list-group-item">Rank : '.$data['articles'][3]['rank'].'</li>
    <li class="list-group-item">Author : '.$data['articles'][3]['author'].'</li>
  </ul>
  <div class="card-body">
  <a href="'.$data['articles'][3]['link'].'" class="card-link">News link</a>
    <a href="#" class="card-link">'.$data['articles'][3]['_id'].'</a>
  </div>
</div>
</div>





            ';
      
        ?>
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