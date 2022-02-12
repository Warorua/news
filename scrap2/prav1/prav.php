<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'https://www.pravda.com.ua/rus/news/2022/02/6/7323032/');
$titles = $response->evaluate('//ol[@class="row"]//li//article//h3/a');
$title = $response->evaluate('//title');
$prices = $response->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
// we can store the prices into an array
$priceArray = [];
foreach ($prices as $key => $price) {
$priceArray[] = $price->textContent;
}
// we extract the titles and display to the terminal together with the prices
foreach ($titles as $key => $title) {
//echo $title->textContent . ' @ '. $priceArray[$key] . PHP_EOL;

}
echo $title->textContent;