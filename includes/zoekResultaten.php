<?php
session_start();

require "connectToDatabase.php";
include "../functions/functions.php";

//initialize $ declare sql-parts
$where = "";
$sqlWhere = "";
$voorraad = "";
$categorie ="";
$prijs = "";

//In header staat "op voorraad" -> wijzigen naar >0 ivm database.
if ($_GET['voorraad'] == "op voorraad"){$_GET['voorraad'] = ">0";};

//Zoek 1 artikel op als klant op "bekijken" heeft geklikt.
if (isset($_POST['bekijkenItem'])){
    $nummer =  $_POST['rowNummer'];
    $sqlWhere = " WHERE nummer = '$nummer'";
}

//bouw de statement op basis van het zoekformulier
if (isset($_GET['typeFiets'])) {

    $categorie = $_GET['typeFiets'];
    $sqlWhere = " WHERE categorie = '$categorie'";

    if (isset($_GET['prijs'])&& (isset($_GET['typeFiets']))) {

        $prijs = $_GET['prijs'];
        $sqlWhere .= " AND prijs $prijs ";
    }
    if (isset($_GET['voorraad']) && (isset($_GET['typeFiets']))) {

        $voorraad = $_GET['voorraad'];
        $sqlWhere .= " AND voorrad $voorraad ";
    }
}

if (isset($_GET['prijs']) && (!isset($_GET['typeFiets']))) {

    $prijs = $_GET['prijs'];
    $sqlWhere = " WHERE prijs $prijs ";

    if (isset($_GET['voorraad'])) {

        $voorraad = $_GET['voorraad'];
        $sqlWhere .= " AND voorrad $voorraad ";
    }
}
if (isset($_GET['voorraad'])
    && (!isset($_GET['prijs'])
        && (!isset($_GET['typeFiets'])))) {

    $voorraad = $_GET['voorraad'];
    $sqlWhere = " WHERE voorrad $voorraad ";
}

//voer de statement uit in sql
$dbStatement = $dbh->prepare("SELECT * FROM producten $sqlWhere");
$dbStatement->execute();
$data = $dbStatement;

//opruimen $sqlWhere
$sqlWhere = "";

//maak  html-variabele van dbStatement
$dbData = $data;
getDataAndShowItems($dbData);

header("Location: ../assortiment.php");
?>

