<?php
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = 'https://www.unian.ua/';
$output = '';
//Title
$response = $httpClient->load($link);
$title = $response->find('.main-unit div.main-unit__info h3 a.main-unit__title', 0)->plaintext . PHP_EOL . PHP_EOL;
echo $title."<br/>";
//Image
$img = $response->find('.content-column div.main-unit a img');
echo $img[1]->src.'<br/>';
//echo sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('.content-column div.main-unit div.main-unit__info h3 a[href]');
$f_href = $href[0]->href;
echo $f_href.'<br/>';
//echo sizeof($href).' - size of href array <br/>';
//Date
$date =  $response->find('.content-column div.main-unit div.main-unit__bottom div.main-unit__time');
echo $date[0]->plaintext."<br/>";
//echo sizeof($date).' - size of date array <br/>';
//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
echo '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);
//Author Fetch
$author = $content->find('.article__info p.article__author--bottom a.article__author-name');
echo $author[0]->plaintext." - <b>Author</b> <br/><br/>";
//Article Content Fetch
echo '<h3>Article content</h3>';
$article =  $content->find('.article-text p');
foreach($article as $ar){
    echo $ar->plaintext."<br/>";
}
$ar_full = join($article);
$ar_size = strlen($ar_full);
echo "<b>Size of this article is ".$ar_size."</b><br/>";
if($ar_size < 700){
    echo '<b style="color:red">Not fetched. Characters < 700</b>';
}
elseif($ar_size > 1000){
    echo '<b style="color:red">Not fetched. Characters > 1000</b>';
}
else{
    echo '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
}
//Image Fetch
echo '<h3>Image</h3>';
$img_2 =  $content->find('.article-text img');
$img_f = $img_2[0]->src;
echo $img_f."<br/>";
echo '<img src='.$img_f.'/>';
//Tags Fetch
echo '<h3>Tags</h3>';
$tag =  $content->find('.article__tags a.article__tag');
echo '<ol>';
foreach($tag as $tg){
    echo '<li>'.$tg->plaintext."</li><br/>";
}
echo '</ol>';
//Name of photographer fetch

//Category fetch
$cat =  $content->find('.top-bredcr div.breadcrumbs ol li a span');
echo '<b>News category</b> - '.$cat[1]->plaintext;
//echo sizeof($a_dec).' - size of article array <br/>';

//echo $a_dec[1]['articleBody'];

