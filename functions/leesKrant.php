<?php

function leesKrant($url)
{
    $arrayOfTitles = extractTitles($url);
    return makeHtmlFromTitlesIn($arrayOfTitles);

}
function makeHtmlFromTitlesIn($array){
    $html = "";
    foreach ($array as $item){
        $html .= $item;
    }
    return $html;
}


function extractTitles($url)
{
    $contentsAsString = getRawHtml($url);
    $stringsWithEnd = discardFrontHtml($contentsAsString);
    $cleanListItems = cleanStringsAndMakeListItem($stringsWithEnd);
    return $cleanListItems;
}

function cleanStringsAndMakeListItem($stringsWithEnd){
    $array=[];
    for ($i = 1; $i< sizeof($stringsWithEnd); $i++) {
        $array[$i-1] = makeListItem(cleanStringToTitle($stringsWithEnd[$i]));
    }
    return $array;
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



