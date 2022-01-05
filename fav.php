<?php

include 'includes/session.php';



$url = "https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://www.stackoverflow.com&size=50";
/*
$gen = "cnn";
$filee = basename($url);
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".".$ext;
$path = 'favs/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img;

$conn = $pdo->open();
$stmt = $conn->prepare("INSERT INTO favs (url, name) VALUES (:url, :name)");
$stmt->execute(['url'=>$url, 'name'=>$filename]);
echo "Photo downloaded and saved successfully!";

echo '<img src="https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://www.stackoverflow.com&size=50" />';

*/
$date = gmdate("D, d M Y H:i:s T");
$start = strtotime($date);
$end = strtotime("Tue, 04 Jan 2022 21:08:49 GMT");
$hours = intval(($start - $end)/60);
$mins = $hours/60;
echo $hours." Minutes</br>".$mins." Hours";
?>
