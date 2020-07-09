<?php
//include "header.php";
include "../functions/functions.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//make connection to DB
try {
    $dbh = new PDO(
        'mysql:host=localhost;
        dbname=webshop',
        "root",
        "");
//    echo "Er is verbinding.";
} catch (Exception $e) {
    echo "Er is iets fout gegaan met de verbinding.";
}

//make sql query to get voorraad from the $_SESSION['itemsShoppingcart']
$productnummer = null;
for ($i = 0; $i < sizeof($_SESSION['itemsShoppingCart']); $i++) {
    $productnummer = $_SESSION['itemsShoppingCart'][$i];

    $dbStatement = $dbh->prepare("SELECT * FROM producten WHERE NUMMER = $productnummer");
    $dbStatement->execute();
    $data = $dbStatement;

//make sql query to adapt voorraad
    while ($row = $data->fetch()) {

        $voorraad[$i] = $row['voorrad'];
//        echo $row['nummer'] . " --> " . $row['voorrad'] . " , ";
        $voorraad[$i] -= 1;

        $query = "UPDATE producten set voorrad = $voorraad[$i] where nummer = $productnummer";

        $dbRemoveStatement = $dbh->prepare($query);
        $dbRemoveStatement->execute();
    }
}

//opslaanBestelling();
//print_r($_SESSION['gebruikersnaam']);
insertBestellingDB($_SESSION['gebruikersnaam'], $_SESSION['itemsShoppingCart']);

$_SESSION['itemsShoppingCart'] = null;
$_SESSION['htmlShoppingCart'] = null;
$_SESSION['afgerekend'] = true;

header("Location: ../shoppingCart.php");