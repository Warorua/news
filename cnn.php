<?php 
$data = file_get_contents("https://edition.cnn.com/search/?q=ukraine&size=10&category=us,politics,world,opinion,health");
$html_sourcecode_get = htmlentities($data);
//echo $html_sourcecode_get;
echo $data;
?>