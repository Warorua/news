<?php
//$html = new simple_html_dom();
include_once('inc/simple_html_dom.php');
include 'includes/session.php';
require 'vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
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
$response = curl_exec($ch);
$resp = str_get_html($response);
//echo $result
//$link = 'https://korrespondent.net/';
$output = '';
//Title
//$response = $httpClient->load($link);
//$json = $response->find('head script[type]');
$json = $resp->find('title');
$jsonn = $json[0]->plaintext;
$output .= $jsonn."<br/>";
echo $output;
?>
