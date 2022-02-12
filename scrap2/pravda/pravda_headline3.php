
<?php
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
$url="https://www.pravda.com.ua/";
$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_URL,$url);
$resp = curl_exec($ch);
$response = str_get_html($resp);
//echo $result
//$link = 'https://korrespondent.net/';
$output = '';
//Title
//$response = $httpClient->load($link);
//$json = $response->find('head script[type]');
$output = '';
//Title
$title = $response->find('.article div.article_body div.article_content_wrapper div.article_content div.article_footer div.article_footer_header a', 2)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title."<br/>";
//Image
//$img = $response->find('.article div.article_body div.article_content_wrapper div.article_content div.article_footer div.article_footer_header a');
//$pic_1 = $img[0]->src;
//$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('.article div.article_body div.article_content_wrapper div.article_content div.article_footer div.article_footer_header a');
$f_href = $href[2]->href;
$output .= $f_href.'<br/>';

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////

$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = 'https://www.pravda.com.ua'.$f_href;
//$output .= $h_link .' ----||||||<br/>';
////////////////////////////////////////////////////////////////////////////////////////

//$url="https://www.pravda.com.ua/news/2022/02/6/7323032/";
//$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_URL, $h_link);
$response = curl_exec($ch);
$content = str_get_html($response);
//echo $result
//$link = 'https://korrespondent.net/';
//Title
//$response = $httpClient->load($link);
//$json = $response->find('head script[type]');
$json = $content->find('head script[type=application/ld+json]');

$js_1 = $json[0]->innertext;
$rtt = strval($js_1);
$datt = json_decode($rtt, TRUE);
//echo json_decode($rt, TRUE);
//$output .= $js_1."<br/><br/>";

//echo sizeof($json)." size of json<br/>";

///////////////////////////////////////////////////////////////////////////////////////
//Date
$date =  $content->find('.main_content div.container_news article.post header.post_header div.post_time');
$published = "";
foreach($date as $row){
$published .= $row->plaintext;
$output .= $published."<br/>";
}


//Author Fetch
$author = $content->find('.main_content div.container_news article.post div.block_post div.post__source');

//$p_author = "Unknown author";
if(sizeof($author) == 0){
    $p_author = mb_convert_encoding("Українська правда", "cp1251");
}

elseif($author[0]->plaintext == ""){
    $p_author = mb_convert_encoding("Українська правда", "cp1251");
}
else{
   $p_auth = $author[0]->plaintext;
   $p_author = $p_auth;
}
$output .= $p_author." - <b>Author</b> <br/><br/>";
//Video Fetch
$output .= '<h3>Video</h3>';
$video_2 =  $content->find('div.block_post div.post_content div.post_content_wrapper div.post_text iframe');
if(sizeof($video_2) == 0){
    $news_type = "interview";
    $video_f = "";
    $output .= $video_f."<br/>";
}
else{
$news_type = "interview";
$video_f = $video_2[0]->src;
$output .= $video_f."<br/>";
$output .= '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$video_f.'" style="border:none;overflow:hidden" width="560"></iframe>';

}
//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('.main_content div.container_news article.post div.block_post div.post_text p');
$ar_1 = '';
foreach($article as $ar){
    $output .= $ar->plaintext."<br/>";
    $ar_1 .= $ar->plaintext."<br/>";
}
//$output .= sizeof($article)." size of article<br/>";
//$ar_full = join($article);
$ar_full = $ar_1;
$ar_size = strlen($ar_full);
$output .= "<b>Size of this article is ".$ar_size."</b><br/>";
if($ar_size < 700){
    $output .= '<b style="color:red">Not fetched. Characters < 700</b>';
}
elseif($ar_size > 1000){
    $output .= '<b style="color:red">Not fetched. Characters > 1000</b>';
}
else{
    $output .= '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
}
$img_f = "";
//Image Fetch
$output .= '<h3>Image</h3>';
$img_2 =  $content->find('meta[name=twitter:image:src]');
foreach($img_2 as $row2){
    $img_f = $row2->content;
$output .= $img_f."<br/>";
$output .= '<img src="'.$img_f.'"/>';
}

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('.main_content div.container_news article.post div.block_post div.post_tags span.post_tags_item');
if(isset($tag[0])){
    $tag1 = $tag[0]->plaintext;
}
else{
    $tag1 = "";
}
if(isset($tag[1])){
    $tag2 = $tag[1]->plaintext;
}
else{
    $tag2 = "";
}
if(isset($tag[2])){
    $tag3 = $tag[2]->plaintext;
}
else{
    $tag3 = "";
}
$output .= '<ol>';
foreach($tag as $tg){
    $output .= '<li>'.$tg->plaintext."</li><br/>";
}
$output .= '</ol>';
//Name of photographer fetch
$output .= '<h2>Photographer</h2>';
$p_graph =  $content->find('.main_content div.container_news article.post div.block_post div.post_photo_about div.post_photo_author');
if(sizeof($p_graph) != 0){
  $f_graph = $p_graph[0]->plaintext;
$trm = mb_convert_encoding("ФОТО", "cp1251");
$photographer = strtok($f_graph, $trm);

//$photographer = strtok($f_graph, $trm);
 

}
else{
    $photographer = "None"; 
}
$output .= $photographer.'<br/>';
////////Test env

//////////
//Category fetch
//$cat =  $content->find('.top-bredcr div.breadcrumbs ol li a span');
//$p_cat = utf8_decode("Політика");
$p_cat = mb_convert_encoding("Політика", "cp1251");
$output .= '<b>News category</b> - '.$p_cat;

//Image URL
$image = $img_f;

$output .= '<img src="'.$image.'"/>';

///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code
$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code='prav_'.substr(str_shuffle($set), 0, 12);


//Insertion process
$time = date("D, d M Y H:i:s");
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE published=:published AND title=:title");
$stmt->execute(['published'=>$published, 'title'=>$title]);

$ct = $stmt->fetch();

if($ct['numrows'] < 1){
  // Download image, rename it and put it into folder
$url = $image;
$gen = 'prav'.time();
$filee = basename($url);
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".".$ext;
$path = '../images/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img;  
$parent = "pravda.com.ua";
//insert into database
  $stmt = $conn->prepare("INSERT INTO news (video_url, type, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:video_url, :type, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
  $stmt->execute(['video_url'=>$video_f, 'type'=>$news_type, 'parent'=>$parent, 'source'=>"pravda.com.ua", 'deep_link'=>$h_link, 'title'=>$title, 'published'=>$published, 'author'=>$p_author, 'article'=>$ar_full, 'tag_1'=>$tag1, 'tag_2'=>$tag2, 'tag_3'=>$tag3, 'photo'=>$filename, 'photo_url'=>$image, 'p_grapher'=>$photographer, 'category'=>$p_cat, 'time'=>$time, 'code'=>$code]);
 $output .= '<h1>New Postage Successfully Added</h1>';
}
else{
 $stmt = $conn->prepare("SELECT * FROM news WHERE published=:published AND title=:title");
    $stmt->execute(['published'=>$published, 'title'=>$title]);
    
    $ct_p = $stmt->fetch();
    
    $output .= '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id='.$ct_p['code'].'" target="_blank" >Preview</a></h1>';
}

echo $output;