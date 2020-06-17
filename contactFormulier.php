<?php
include "includes/header.php";
include "functions/functions.php";

$contents ="Wij zijn de makers van de webshop. Je kunt ons bereiken op het volgende adres: infovande@webshop.nl";
$contents .= "<img src='images/Fietser.gif' alt='makers van de site' width=300 height=200>";

echo makeMainSection(makeArticle(
    "Over ons", $contents,
    "voorwaarden"));

include "includes/footer.php"; ?>
