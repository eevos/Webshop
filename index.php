<?php
include "includes/header.php";
include "functions/functions.php";

$html = array();
$html =
    [
        ["htmlTitle" => "Welkom!",
            "htmlContents" => "Het is vandaag " . date("l") . ", " . date("d M Y") . ". <br>" .
                            "Zoek door ons assortiment met het zoekscherm of via de knop 'assortiment'."],
        ["htmlTitle" => "Assortiment",
            "htmlContents" => makeLink("assortiment.php", "Klik hier om te zoeken in het assortiment.")],
        ["htmlTitle" => "Voorwaarden",
            "htmlContents" => makeLink("voorwaarden.php", "Klik hier om de voorwaarden te bekijken.")],
        ["htmlTitle" => "Contact",
            "htmlContents" => makeLink("contactFormulier.php", "Klik hier om contact te zoeken")],
        ["htmlTitle" => "Winkelwagen",
            "htmlContents" => makeLink("shoppingCart.php", "Klik hier om je winkelwagen te bekijken")],
        ["htmlTitle" => "Account",
            "htmlContents" => makeLink("signup.php", "Klik hier om een account aan te maken")],
        ["htmlTitle" => "Inlogpagina",
            "htmlContents" => makeLink("login.php", "Klik hier om in- of uit te loggen")],

    ];


function fillIndex($html){
$htmlArticles = "";
for ($i = 0; $i < count($html); $i++) {
    $htmlArticles .= makeArticle($html[$i]["htmlTitle"], $html[$i]["htmlContents"], null);
}
return makeMainSection($htmlArticles);
}

echo fillIndex($html);



include "includes/footer.php"; ?>