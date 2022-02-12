<?php
header("Content-Type: text/html; charset=BIG-5");
$ch2=curl_init($h_link);
curl_setopt_array($ch2,array(
        CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
        CURLOPT_ENCODING=>'gzip, deflate',
        CURLOPT_HTTPHEADER=>array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
        ),
));
$resp = curl_exec($ch2);
echo $response;