<?php
//setlocale(LC_ALL, "uk_UA.KOI8-U");
header("Content-Type: text/html; charset=BIG-5");
//header("Content-Type: text/html; charset=utf-8");
$url="https://www.pravda.com.ua/news/2022/02/6/7323032/";
$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);

echo $result
?>