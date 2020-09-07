<?php
include "functions.php";

function leesKrant()
{
        scanTitles();

}
$urlToScan = "https://www.volkskrant.nl/nieuws";
scanTitles($urlToScan);

function scanTitles($url)
{
    $contentsAsString = getRawHtml($url);
    $stringsWithEnd = discardFrontHtml($contentsAsString);
    echo "we hebben " . sizeof($stringsWithEnd) . " titles voor je gevonden: ";
    echo cleanStrings($stringsWithEnd);

}

function cleanStrings($stringsWithEnd){
    $html="";
    for ($i = 1; $i< sizeof($stringsWithEnd); $i++) {
        $html .= cleanStringToTitle($stringsWithEnd[$i]);
    }
    return $html;
}
function cleanStringToTitle($string){
    $title = explode("data-gtm=", $string);
    return $title[0];
}


function discardFrontHtml($contentsAsString){
    return explode("aria-label=", $contentsAsString);
}
function getRawHtml($url){
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL,$url);
    curl_setopt($c, CURLOPT_HEADER,TRUE  );
    curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
    return curl_exec($c);
}



