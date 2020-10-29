
<?php
include "functions/leesKrant.php";

//$token = $_POST['token'];


$token = "-";

$url =
    "https://www.solaxcloud.com:9443/proxy/api/getRealtimeInfo.do?tokenId=" . $token . "&sn=SPMH55R28K";

function visitUrl($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($c);
}

$json = visitUrl($url);
$array = json_decode($json, true);
print_r($array["result"]);
echo $array["result"]["inverterStatus"];

