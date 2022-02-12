
<?php
include_once('inc/simple_html_dom.php');
include 'includes/session.php';
require 'vendor/autoload.php';
require_once('vendor\neitanod\forceutf8\src\ForceUTF8\Encoding.php');
use \ForceUTF8\Encoding;
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
//setlocale(LC_ALL, "uk_UA.KOI8-U");
header("Content-Type: text/html; charset=BIG-5");
//header("Content-Type: text/html; charset=cp1251");
$url="https://life.pravda.com.ua/society/";
$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36 Edg/91.0.864.59';

$ch=curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt_array($ch,array(
        CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
        CURLOPT_ENCODING=>'gzip, deflate',
       // CURLOPT_RETURNTRANSFER=>TRUE,
        CURLOPT_HTTPHEADER=>array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
        ),
));

$resp = curl_exec($ch);
//curl_close($ch);
$response = str_get_html($resp);
//echo $result
//$link = 'https://korrespondent.net/';
$output = '';
//Title
//$response = $httpClient->load($link);
//$json = $response->find('head script[type]');
//$output .= $response;
//Title

$title_1 = $response->find('div.pagewrap div.content-wrap div.content-block-center div.img-wrap div.text-wrap div.text-block h2.head a', 0)->plaintext . PHP_EOL . PHP_EOL;

$output .= $title_1."<br/>";
//Image
//$img = $response->find('.theme-top');
//$pic_1 = $img[0]->src;
//$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('div.pagewrap div.content-wrap div.content-block-center div.img-wrap div.text-wrap div.text-block h2.head a');
$f_href = $href[0]->href;
$output .= $f_href.'<br/>';

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////

$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = 'https://life.pravda.com.ua'.$f_href;
$output .= $h_link .'<br/>';
////////////////////////////////////////////////////////////////////////////////////////

//$url="https://www.pravda.com.ua/news/2022/02/6/7323032/";
//$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

$ch2=curl_init($h_link);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt_array($ch2,array(
        CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
        CURLOPT_ENCODING=>'gzip, deflate',
        CURLOPT_RETURNTRANSFER=>TRUE,
        CURLOPT_HTTPHEADER=>array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*//*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
        ),
));
$response = curl_exec($ch2);
$content = str_get_html($response);
//echo $result
//$link = 'https://korrespondent.net/';
//Title
//$response = $httpClient->load($link);
//$json = $response->find('head script[type]');

//Title recollect
$tit_1 = $content->find('div.page-head-block div.img-wrap div.text-wrap div.text-block h1.head');
$title = $tit_1[0]->plaintext;
$output .= "<h3>".$title."</h3><br/>";

$json = $content->find('head script[type=application/ld+json]');

$js_1 = $json[0]->innertext;
$rtt_1 = strval($js_1);
//$rtt1 = utf8_decode($rtt_1);
$rtt = mb_convert_encoding($rtt_1, "BIG-5");
//$rtt = Encoding::fixUTF8($rtt_1);

$datt = json_decode($rtt, TRUE);
//echo json_decode($rt, TRUE);
$output .= $rtt."<br/><br/>";

//echo sizeof($json)." size of json<br/>";

///////////////////////////////////////////////////////////////////////////////////////
//Date
//$date =  $content->find('article div.article__wide div.article__wide__content div.layout_width_second header.post__header div.post__time', 0)->plaintext;
//$date_sub = $content->find('article div.article__wide div.article__wide__content div.layout_width_second header.post__header div.post__time span.post__author', 0)->plaintext;
//$published = ltrim($date, $date_sub);
$published = $datt['datePublished'];
$output .= $published."<br/>";


////////////TEST
$test_0 = $datt['author']['name'];
$test_1 = mb_convert_encoding($test_0, "GB18030");
//$test_1 = Encoding::toLatin1($test_0);
$output .= $test_1."<br/>";
////////////

//Author Fetch
$author = $content->find('div.pagewrap div.main-page-wrap div.article-flex-wrap div.article-column div.article-wrap div.sidebar-autor-block div.article-announcement-block span.autor-name');

//$p_author = "Unknown author";
if(sizeof($author) == 0){
    $p_author = mb_convert_encoding("Українська правда _Життя", "cp1251");
}

elseif($author[0]->plaintext == ""){
    $p_author = mb_convert_encoding("Українська правда _Життя", "cp1251");
}
else{
   $p_auth = $author[0]->plaintext;
   $p_author = $p_auth;
}
$output .= $p_author." - <b>Author</b> <br/><br/>";

//Video Fetch
$output .= '<h3>Video</h3>';
$video_2 =  $content->find('div.pagewrap div.main-page-wrap div.article-flex-wrap div.article-column div.article-wrap article.article iframe');
if(sizeof($video_2) == 0){
    $news_type = "";
    $video_f = "";
    $output .= $video_f."<br/>";
}
else{
$news_type = "";
$video_f = $video_2[0]->src;
$output .= $video_f."<br/>";
$output .= '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$video_f.'" style="border:none;overflow:hidden" width="560"></iframe>';

}

//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('div.pagewrap div.main-page-wrap div.article-flex-wrap div.article-column div.article-wrap article.article p');
$ar_1 = '';
foreach($article as $ar){
    $output .= $ar->innertext."<br/>";
    $ar_1 .= $ar->innertext."<br/>";
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
//$img_2 =  $content->find('article[!class] div.article__wide img.article__wide__img');

$img_f = $datt['image']['url'];
$output .= $img_f."<br/>";
$output .= '<img src="'.$img_f.'"/>';


//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('div.block_post div.post__tags span.post__tags__item a');
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
 
}
else{
    $photographer = "None"; 
}
$output .= $photographer.'<br/>';
//////////////////////////////TESt
$sample = "Новини від ukrzmi.com в Telegram. Підписуйтесь на наш канал";
echo '<h1>'.trim($sample,"Новини від ukrzmi.com вПідписуйтесь на наш канал").'</h1>';


/////////////////////////////

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
$parent = "life.pravda.com.ua";
//insert into database
  $stmt = $conn->prepare("INSERT INTO news (video_url, type, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:video_url, :type, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
  $stmt->execute(['video_url'=>$video_f, 'type'=>$news_type, 'parent'=>$parent, 'source'=>"life.pravda.com.ua/society/", 'deep_link'=>$h_link, 'title'=>$title, 'published'=>$published, 'author'=>$p_author, 'article'=>$ar_full, 'tag_1'=>$tag1, 'tag_2'=>$tag2, 'tag_3'=>$tag3, 'photo'=>$filename, 'photo_url'=>$image, 'p_grapher'=>$photographer, 'category'=>mb_convert_encoding("Cуспільства", "cp1251"), 'time'=>$time, 'code'=>$code]);
 $output .= '<h1>New Postage Successfully Added</h1>';
}
else{
 $stmt = $conn->prepare("SELECT * FROM news WHERE published=:published AND title=:title");
    $stmt->execute(['published'=>$published, 'title'=>$title]);
    
    $ct_p = $stmt->fetch();
    
    $output .= '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id='.$ct_p['code'].'" target="_blank" >Preview</a></h1>';
}

echo $output;