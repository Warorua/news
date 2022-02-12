<?php
set_time_limit(500); // 
include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = 'https://ua.korrespondent.net/city/kiev/';
$output = '';
//Title
$response = $httpClient->load($link);
//$title = $response->find('.clone-content div.article_main div.royalSlider div.article div.article__title a', 0)->plaintext . PHP_EOL . PHP_EOL;
//Image
$img = $response->find('.col__big div.article_top a.article__img-link img');
$pic_1 = $img[0]->src;
$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';

//Link HREF
$href =  $response->find('.col__big div.article_top a.article__img-link');
$f_href = $href[0]->href;
$output .= $f_href.'<br/>';

//Date
$date =  $response->find('.col__big div.article_top div.article__date');
$published = $date[0]->plaintext;
$output .= $published."<br/>";

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);
//Title
$output .= '<h3>Article Title</h3>';
$tit_01 = $content->find('.post-item h1.post-item__title');
$tit_f = $tit_01[0]->plaintext;
$output .= $tit_f.' [ORIGINAL FULL]<br/>';

$tit_em = $content->find('.post-item h1.post-item__title em');
if(sizeof($tit_em) != 0){
  $tit_em_f = $tit_em[0]->plaintext;
$output .= $tit_em_f.' [ORIGINAL TO REMOVE]<br/><br/>';
$title = str_replace($tit_em_f, "", $tit_f);  
}
else{
   $title = $tit_f; 
}

$output .= $title."<br/>";
//Author Fetch
$author = $content->find('.col__big div.post-item div.post-item__info a.article__author');
$p_author = $author[0]->plaintext;
$output .= $p_author." - <b>Author</b> <br/><br/>";

//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article_p = $content->find('.col__big div.post-item div.post-item__text p');
$output .= sizeof($article_p)." - <b>Size of P array</b><br/>";
$article_div = $content->find('.col__big div.post-item div.post-item__text div');
$output .= sizeof($article_div)." - <b>Size of DIV array</b><br/>";
$s_article_p = sizeof($article_p);
$s_article_div = sizeof($article_div);
if($s_article_p > $s_article_div){
    $article = $content->find('.col__big div.post-item div.post-item__text p[!class]'); 
}
elseif($s_article_div > $s_article_p){
    $article = $content->find('.col__big div.post-item div.post-item__text div[!class]');
}

$ar_0 = '';
$ar_arr = sizeof($article);
foreach($article as $ar => $ar_sz){
    //$output .= $ar->plaintext."<br/>";
    if($ar != ($ar_arr-1)){
    $ar_0 .= $ar_sz->plaintext."<br/>";
     }
    else{
        break;
    }
}
$ar_1 = $ar_0;
$output .= $ar_1."<br/>";
$ar_full = join($article);
$ar_full = $ar_1;
$ar_size = strlen($ar_full);
$output .= "<b>Size of this article is ".$ar_size." and has ".$ar_arr." array items</b><br/>";
$output .= "Last item that will be removed: <b>".$article[$ar_arr-1]->plaintext."</b><br/>";
if($ar_size < 700){
    $output .= '<b style="color:red">Not fetched. Characters < 700</b>';
}
elseif($ar_size > 1000){
    $output .= '<b style="color:red">Not fetched. Characters > 1000</b>';
}
else{
    $output .= '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
}

//Image Fetch
$output .= '<h3>Image</h3>';
$img_2 =  $content->find('.col__big div.post-item div.post-item__photo img');
$img_f = $img_2[0]->src;
$output .= $img_f."<br/>";
$output .= '<img src='.$img_f.'/>';

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('.col__big div.post-item div.post-item__tags div.post-item__tags-item a');
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
$output .= '<h3>Photographer</h3>';
$p_graph =  $content->find('.col__big div.post-item div.post-item__photo div.post-item__photo-about div.post-item__photo-author');
if(sizeof($p_graph) == 0){
    $photographer = "Жодного";
}
else{
 $f_graph = $p_graph[0]->plaintext;
$photographer = str_replace("Фото:"," ", $f_graph);
}

$output .= '<b>Photographer</b> - '.$photographer.'</br>';
//Category fetch
//$cat =  $content->find('.header-menu div.header ul.nav li.nav__item a.nav__link_active');
//$p_cat = $cat[0]->plaintext;
$p_cat = "Київ";
$output .= '<b>News category</b> - '.$p_cat;

   $image = $img_f;
$output .= '<img src="'.$image.'"/>';

///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code
$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = 'korr_'.substr(str_shuffle($set), 0, 12);

//Insertion process
$time = date("D, d M Y H:i:s");
$parent = "ua.korrespondent.net";
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE title=:title AND parent=:parent");
$stmt->execute(['title'=>$title, 'parent'=>$parent]);
$ct = $stmt->fetch();
if($ct['numrows'] < 1){
  // Download image, rename it and put it into folder
$url = $image;
$gen = 'korr'.time();
$filee = basename($url);
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".".$ext;
$path = '../images/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img;  
//insert into database
  $stmt = $conn->prepare("INSERT INTO news (parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
  $stmt->execute(['parent'=>$parent, 'source'=>"ua.korrespondent.net/city/kiev/", 'deep_link'=>$f_href, 'title'=>$title, 'published'=>$published, 'author'=>$p_author, 'article'=>$ar_full, 'tag_1'=>$tag1, 'tag_2'=>$tag2, 'tag_3'=>$tag3, 'photo'=>$filename, 'photo_url'=>$image, 'p_grapher'=>$photographer, 'category'=>"Київ", 'time'=>$time, 'code'=>$code]);
 $output .= '<h1>New Postage Successfully Added</h1>';
}
else{
    $output .= '<h1>Article already posted.</h1>';
}

echo $output;
