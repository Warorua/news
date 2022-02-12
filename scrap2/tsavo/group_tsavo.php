
<?php
set_time_limit(100000000000);
include 'includes/session.php';
require '../vendor/autoload.php';
$search_from = $_POST['url'];
$cat_fetch = $_POST['cat'];
$httpClient = new \simplehtmldom\HtmlWeb();
for ($x = 2; $x <= 5; $x++) {
   $search_link = $search_from.'?page='.$x.'#catalog-listing';

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = $search_link;
$response = $httpClient->load($link);
$output = '';
$output2 = '';
//$nm = $response->find('.crs-w div.crs div.itm article.prd a.core');
//$slink = "https://www.jumia.co.ke".$nm[0]->href;

$nm = $response->find('.prd a.core');
foreach($nm as $rrw){
$slink = "https://www.jumia.co.ke".$rrw->href;
$resp = $httpClient->load($slink);

//Name
$output .= '<h2>Name</h2>';
$nme = $resp->find('.col12 div.row div.col10 div.-df div.-fs0 h1.-fs20');
//$output .= sizeof($nme).' - size of name array <br/>';
$name = $nme[0]->plaintext;
$output .= $name.'<br/>';

//Slug
$output .= '<h2>Slug</h2>';
$nme1 = $resp->find('.col12 div.row div.col10 div.-phxs div.-phxs form.-df');
//$nme1_2 =  $resp->find('.col12 div.row div.col10 div.-phxs div.var-w label.vl');
$nme1_2 =  $resp->find('.col12 div.row div.col10 div.-phxs div.var-w input.vi');
if(isset($nme1[0])){
$slug = $nme1[0]->{'data-sku'};
}
elseif(isset($nme1_2[0])){
    $slug = $nme1_2[0]->value;
}

$output .= $slug.'<br/>';

//category_id
$output .= '<h2>Cat</h2>';
$category_id = $cat_fetch;
$output .= $category_id.'<br/>';

//Description
$output .= '<h2>Desc</h2>';
$nme2 = $resp->find('.row div.col12 div.card div.markup');
$description = $nme2[0]->innertext;
$output .= $description.'<br/>';

//price
$output .= '<h2>Price</h2>';
$nme3 = $resp->find('.col12 div.row div.col10 div.-phs div.-hr div span.-b');
$pr = $nme3[0]->innertext;
$price = filter_var($pr, FILTER_SANITIZE_NUMBER_INT);
$price_1 = $price;
$output .= $price.'<br/>';

//Photo url
$output .= '<h2>Photo</h2>';
$nme4 = $resp->find('.col12 div.row div.col6 div.-ptxs div.sldr a');
$photo_url = $nme4[0]->href;
$output .= $photo_url.'<br/>';

//Prev Price
$output .= '<h2>Prev price</h2>';
$nme5 = $resp->find('.col12 div.row div.col10 div.-phs div.-hr div div.-df span.-tal');
if(isset($nme5[0])){
$pr1 = $nme5[0]->plaintext;
$was = filter_var($pr1, FILTER_SANITIZE_NUMBER_INT);
}
else{
    $was = "00";
}
$output .= $was.'<br/>';

//Brand
$output .= '<h2>Brand</h2>';
$nme6 = $resp->find('.col12 div.row div.col10 div.-phs div.-pvxs a._more');
$brand = $nme6[0]->plaintext;
$output .= $brand.'<br/>';

//Weight
$output .= '<h2>Weight</h2>';
$nme7 = $resp->find('.row div.col12 section.card div.row article.col8 div.card-b ul.-pvs li.-pvxs span.-b');
foreach($nme7 as $nm77  => $value){
   
   //$output .= $nm77.' --- '.$value.'<br/>';
   $qery = $value->plaintext;
   if("Weight (kg)" == $qery){
    $nme_f = $resp->find('.row div.col12 section.card div.row article.col8 div.card-b ul.-pvs li.-pvxs');
    $nme7_d = $nme_f[$nm77]->plaintext;
    //$ggoo = "Weight (kg): 1.0";
    $weight = filter_var($nme7_d, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    $output .= $weight;
   }
}

//Width
$output .= '<h2>Width</h2>';
$width = "0.00";
$output .= $width;

//Category
$category = $category_id;

//Percentage Off
$output .= '<h2>Percentage Off</h2>';
$nme8 = $resp->find('.col12 div.row div.col10 div.-phs div.-hr div div.-df span.tag');
if(isset($nme8[0])){
$nme8_d = $nme8[0]->plaintext;
$price_2 = filter_var($nme8_d, FILTER_SANITIZE_NUMBER_INT);
$p_off = $price_2;
$output .= $price_2.'%<br/>';
}
else{
    $price_2 = 0.00;
    $p_off = $price_2;
    $output .= $price_2.'%<br/>';
}


//Product quantity
$output .= '<h2>Product quantity</h2>';
$prod_qty = 10;
$output .= $prod_qty.'<br/>';


//Barcode
$output .= '<h2>Barcode</h2>';
$barcode = '0000000000000000000000';
$output .= $barcode.'<br/>';


//Size
$output .= '<h2>Size</h2>';
$nme9 =  $resp->find('.col12 div.row div.col10 div.-phxs div.var-w label.vl');
if(isset($nme9[0])){
$size = $nme9[0]->plaintext;
}
else{
$size = "--";
}
$output .= $size.'<br/>';

///////////////////////////////////////////VARIATIONS/////////////////////////////////////////////////////////
$output .= '<h1>Variations</h1>';
$nme10 =  $resp->find('body script');
$nme10_v = $nme10[3]->innertext;
$nme10_v1 = substr($nme10_v, 0, strpos($nme10_v, ";"));
$nme10_v2 = str_replace("window.__STORE__=", '', $nme10_v1) ;
$nme10_dc = json_decode($nme10_v2, TRUE);
$variation = $nme10_dc['sku'];
$output .= $variation.'<br/>';
//var 1
if(isset($nme10_dc['simples'][0])){
    $output .= '<h3>Variation 1</h3>';
    $male_shoes = $nme10_dc['simples'][0]['name'];
    $nme10_price = $nme10_dc['simples'][0]['prices']['rawPrice'];
    $output .= $male_shoes.':<b>'.$nme10_price.'</b><br/>';
}
else{
    $male_shoes = "";
    $nme10_price = "";
    $output .= 'Variation 1 is unavailable<br/>';
}
//var 2
if(isset($nme10_dc['simples'][1])){
    $output .= '<h3>Variation 2</h3>';
    $male_shoes_id = $nme10_dc['simples'][1]['name'];
    $female_pants_id = $nme10_dc['simples'][1]['prices']['rawPrice'];
    $output .= $male_shoes_id.':<b>'.$female_pants_id.'</b><br/>';
}
else{
    $male_shoes_id = "";
    $female_pants_id = "";
    $output .= 'Variation 2 is unavailable<br/>';
}
//var 3
if(isset($nme10_dc['simples'][2])){
    $output .= '<h3>Variation 3</h3>';
    $male_pants = $nme10_dc['simples'][2]['name'];
    $field1 = $nme10_dc['simples'][2]['prices']['rawPrice'];
    $output .= $male_pants.':<b>'.$field1.'</b><br/>';
}
else{
    $male_pants = "";
    $field1 = "";
    $output .= 'Variation 3 is unavailable<br/>';
}
//var 4
if(isset($nme10_dc['simples'][3])){
    $output .= '<h3>Variation 4</h3>';
    $male_pants_id = $nme10_dc['simples'][3]['name'];
    $field4 = $nme10_dc['simples'][3]['prices']['rawPrice'];
    $output .= $male_pants_id.':<b>'.$field4.'</b><br/>';
}
else{
    $male_pants_id = "";
    $field4 = "";
    $output .= 'Variation 4 is unavailable<br/>';
}
//var 5
if(isset($nme10_dc['simples'][4])){
    $output .= '<h3>Variation 5</h3>';
    $male_shirts = $nme10_dc['simples'][4]['name'];
    $field5 = $nme10_dc['simples'][4]['prices']['rawPrice'];
    $output .= $male_shirts.':<b>'.$field5.'</b><br/>';
}
else{
    $male_shirts = "";
    $field5 = "";
    $output .= 'Variation 5 is unavailable<br/>';
}
//var 6
if(isset($nme10_dc['simples'][5])){
    $output .= '<h3>Variation 6</h3>';
    $male_shirts_id = $nme10_dc['simples'][5]['name'];
    $field6 = $nme10_dc['simples'][5]['prices']['rawPrice'];
    $output .= $male_shirts_id.':<b>'.$field6.'</b><br/>';
}
else{
    $male_shirts_id = "";
    $field6 = "";
    $output .= 'Variation 6 is unavailable<br/>';
}
//var 7
if(isset($nme10_dc['simples'][6])){
    $output .= '<h3>Variation 7</h3>';
    $female_shoes = $nme10_dc['simples'][6]['name'];
    $categ = $nme10_dc['simples'][6]['prices']['rawPrice'];
    $output .= $female_shoes.':<b>'.$categ.'</b><br/>';
}
else{
    $female_shoes = "";
    $categ = "";
    $output .= 'Variation 7 is unavailable<br/>';
}
//var 8
if(isset($nme10_dc['simples'][7])){
    $output .= '<h3>Variation 8</h3>';
    $female_shoes_id = $nme10_dc['simples'][7]['name'];
    $field2 = $nme10_dc['simples'][7]['prices']['rawPrice'];
    $output .= $female_shoes_id.':<b>'.$field2.'</b><br/>';
}
else{
    $female_shoes_id = "";
    $field2 = "";
    $output .= 'Variation 8 is unavailable<br/>';
}
//var 9
if(isset($nme10_dc['simples'][8])){
    $output .= '<h3>Variation 9</h3>';
    $female_dresses = $nme10_dc['simples'][8]['name'];
    $field7 = $nme10_dc['simples'][8]['prices']['rawPrice'];
    $output .= $female_dresses.':<b>'.$field7.'</b><br/>';
}
else{
    $field7 = "";
$female_dresses = "";
    $output .= 'Variation 9 is unavailable<br/>';
}
//var 10
if(isset($nme10_dc['simples'][9])){
    $output .= '<h3>Variation 10</h3>';
    $female_dresses_id = $nme10_dc['simples'][9]['name'];
    $field8 = $nme10_dc['simples'][9]['prices']['rawPrice'];
    $output .= $female_dresses_id.':<b>'.$field8.'</b><br/>';
}
else{
    $female_dresses_id = "";
    $field8 = "";
    $output .= 'Variation 10 is unavailable<br/>';
}
//Others
$length = '';
$height = '';
$shipping_add = '';
$female_skirts = '';
$female_skirts_id = '';
$female_pants = '';

//More Description
$output .= '<h2>More Description / What is in the box</h2>';
$nme12_1 = $resp->find('.row article.col8 div.card-b div.markup ul');
$nme12_2 = $resp->find('.row article.col8 div.card-b div.markup');
$nm12_11 = '';
$nm12_22 = '';
foreach($nme12_1 as $nm12_1){
    $nm12_11 .= $nm12_1->plaintext.'<br/>';
}
foreach($nme12_2 as $nm12_2){
    $nm12_22 .= $nm12_2->plaintext.'<br/>';
}
$more_desc =  str_replace($nm12_11, '', $nm12_22) ;
$output .= $more_desc.'<br/>';

//adding 'key features' to main description
$output .= '<h2>key features</h2>';
foreach($nme12_1 as $nm13){
    $key_features = $nm13->innertext;
    $output .= $key_features.'<br/>';
}
//Material
$output .= '<h2>Material</h2>';
$nme14 = $resp->find('.row div.col12 section.card div.row article.col8 div.card-b ul.-pvs li.-pvxs span.-b');
foreach($nme14 as $nm14 => $value){
    //$output .= $value->plaintext.'--'.$nm14.'<br/>';
    $nm14_r = $value->plaintext;
    if("Main Material" == $nm14_r){
    $nme14_f = $resp->find('.row div.col12 section.card div.row article.col8 div.card-b ul.-pvs li.-pvxs');
    $nme14_d = $nme14_f[$nm14]->plaintext;
    $nme14_f = str_replace("Main Material: ", '', $nme14_d);
      $material = $nme14_f;
         $output .= $material.'<br/>';
    }
    else{
        $material = '';
    }

}
//Product status
$product_status = 1;
/////////////////////////////////////SELLER INFORMATION//////////////////////////////////////////
//Supplier
$output .= '<h2>Supplier</h2>';
$supplier = $nme10_dc['googleAds']['targeting']['seller'][0];
$output .= $supplier.'<br/>';

//Supplier ID
$output .= '<h2>Supplier ID</h2>';
if(isset($nme10_dc['products'][0]['sellerId'])){
    $supp_id = $nme10_dc['products'][0]['sellerId'];
}
else{
    $supp_id = 'VEND-'.sha1($supplier);
}
$output .= $supp_id.'<br/>';

//date View
$output .= '<h2>Date View</h2>';
$date_view = date("Y/m/d | h:i:sa");
$output .= $date_view.'<br/>';

//Seller URL
$output .= '<h2>Seller URL</h2>';
$nme11 = $resp->find('.col4 div.-pts section.card a');
$seller_url = $nme11[0]->href;
$output .= 'https://www.jumia.co.ke/seller'.$seller_url.'profile/<br/>';

//Seller SKU
$output .= '<h2>Seller SKU</h2>';
$nme15 = date("Y");
$seller_sku = 'TS/JM/'.$supp_id.'/'.$nme15;
$output .= $seller_sku.'<br/>';

//Supp Mail
$output .= '<h2>Supp eMail</h2>';
$nme16 = strtolower(str_replace(' ', '', $supplier));
$supp_email = $nme16.'@vendor.tsavo.store';
$output .= $supp_email.'<br/>';

//Shipping Origin
$output .= '<h2>Shipping Origin</h2>';
$nme17 = $resp->find('.col10 div.-df div.-fs0 a.tag');
if(isset($nme17[0])){
if($nme17[0]->plaintext == "Shipped from abroad"){
    $ship_orig = 'Abroad';
}
else{
    $ship_orig = "Kenya";
}
}
else{
    $ship_orig = "Kenya";
}
$output .= $ship_orig.'<br/>';
//seller account details
$password = password_hash($nme16.'2021', PASSWORD_DEFAULT);
$shopname = $nme16;
		$fullname = $supplier;
		$email = $supp_email;
		$address = $ship_orig;
		$terms = 1;
		$contact_info = '0700000000';
		$created_on = date("Y/m/d | h:i:sa");
		$seller_id = $supp_id;
		$type = 2;
		$crpt = time();
		$crpto = $crpt + $crpt;
		$shop_id = $seller_sku;

/////////////////////////////CREATE VENDOR ACCOUNT////////////////////////////////
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM supplier WHERE supp_slug=:supp_slug");
$stmt->execute(['supp_slug'=>$seller_id]);
$supp_count = $stmt->fetch();
if($supp_count['numrows'] < 1){
    $stmt = $conn->prepare("INSERT INTO supplier (email, supp_contact, address, field1, supp_name, name, type, created_on, supp_slug, terms_conditions, shop_id) VALUES (:email, :supp_contact, :address, :field1, :supp_name, :name, :type, :created_on, :supp_slug, :terms_conditions, :shop_id)");
    $stmt->execute(['email'=>$email, 'supp_contact'=>$contact_info, 'address'=>$address, 'field1'=>$password, 'supp_name'=>$fullname, 'name'=>$shopname, 'type'=>$type, 'created_on'=>$created_on, 'supp_slug'=>$seller_id, 'terms_conditions'=>$terms, 'shop_id'=>$shop_id]);
    $output2 .= '<div class="alert alert-primary" role="alert">Vendor Account Created Successfully</div><br/>';
}
else{
    $output2 .= '<div class="alert alert-danger" role="alert">Supplier Already in the Database</div><br/>';
}

/////////////////INSERT PRODUCTS INTO THE DATABASE///////////////////////////////
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE slug=:slug");
$stmt->execute(['slug'=>$slug]);
$prod_count = $stmt->fetch();
if($prod_count['numrows'] < 1){

    // Download image, rename it and put it into folder
$url = $photo_url;
$set='1234567890';
//$code=substr(str_shuffle($set), 0, 8);
$code =time();
$gen = $nme16.$code;
$filee = basename($url);
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".jpg";
$path = '../../../tsavo_vendor/images/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img;  

$method = "Scrap";

    $stmt = $conn->prepare("INSERT INTO products (more_desc, method, category_id, name, description, slug, price, photo, date_view, was, brand, weight, width, category, price_1, price_2, prod_qty, supplier, supp_id, length, height, supp_cont, p_off, material, seller_sku, supp_email, ship_orig, product_status, male_shoes, male_shoes_id, male_pants, male_pants_id, male_shirts, male_shirts_id, female_shoes, female_shoes_id, female_skirts, female_skirts_id, female_pants, female_pants_id, field1, field4, field5, field6, categ, field2, field7, field8) VALUES (:more_desc, :method, :category_id, :name, :description, :slug, :price, :photo, :date_view, :was, :brand, :weight, :width, :category, :price_1, :price_2, :prod_qty, :supplier, :supp_id, :length, :height, :supp_cont, :p_off, :material, :seller_sku, :supp_email, :ship_orig, :product_status, :male_shoes, :male_shoes_id, :male_pants, :male_pants_id, :male_shirts, :male_shirts_id, :female_shoes, :female_shoes_id, :female_skirts, :female_skirts_id, :female_pants, :female_pants_id, :field1, :field4, :field5, :field6, :categ, :field2, :field7, :field8)");
    $stmt->execute([
        'more_desc'=>$more_desc,
        'method'=>$method,
        'category_id'=>$category_id,
        'name'=>$name,
        'description'=>$description,
        'slug'=>$slug,
        'price'=>$price,
         'photo'=>$filename,
          'date_view'=>$date_view,
           'was'=>$was,
            'brand'=>$brand,
             'weight'=>$weight,
              'width'=>$width,
               'category'=>$category_id,
                'price_1'=>$price_1,
                 'price_2'=>$price_2,
                  'prod_qty'=>$prod_qty,
                   'supplier'=>$supplier,
                    'supp_id'=>$seller_sku,
                     'length'=>$length,
                      'height'=>$height,
                       'supp_cont'=>$contact_info,
                        'p_off'=>$p_off,
                         'material'=>$material,
                          'seller_sku'=>$seller_sku,
                           'supp_email'=>$supp_email,
                            'ship_orig'=>$ship_orig,
                             'product_status'=>$product_status,
                              'male_shoes'=>$male_shoes,
                               'male_shoes_id'=>$male_shoes_id,
                               'male_pants'=>$male_pants,
                                'male_pants_id'=>$male_pants_id,
                                'male_shirts'=>$male_shirts,
                                 'male_shirts_id'=>$male_shirts_id,
                                  'female_shoes'=>$female_shoes,
                                   'female_shoes_id'=>$female_shoes_id,
                                    'female_skirts'=>$female_skirts,
                                     'female_skirts_id'=>$female_skirts_id,
                                      'female_pants'=>$female_pants,
                                       'female_pants_id'=>$female_pants_id,
                                        'field1'=>$field1,
                                         'field4'=>$field4,
                                          'field5'=>$field5,
                                           'field6'=>$field6,
                                            'categ'=>$categ,
                                             'field2'=>$field2,
                                              'field7'=>$field7,
                                               'field8'=>$field8
                                            ]);
   $output2 .= '<div class="alert alert-primary" role="alert">Product Inserted into the Database successfully</div><br/>';
}
else{
    $output2 .= '<div class="alert alert-danger" role="alert">Product Already in the Database</div><br/>';
}
}
}
/*
foreach($nm as $nm_1){
   $dlink = "https://www.jumia.co.ke".$nm_1->href;


}
*/
$output .= " 
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
 <script>
                $('img').each(function() {
                var imageDataSource = $(this).data('src').toString();
              var setImageSource = $(this).attr('src', imageDataSource);
            });
            </script>
";
$output3 .= '<div class="alert alert-primary" role="alert">Operation finished successfully</div><br/>';

 echo $output3;

?>

