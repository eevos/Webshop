<?php
session_start();

require "connectToDatabase.php";

$sqlCategory = "kinderfiets";

//voer de statement uit in sql
$dbStatement = $dbh->prepare("SELECT * FROM producten where category = $sqlCategory");
$dbStatement->execute();
$data = $dbStatement;

//opruimen $sqlWhere
$sqlCategory = "";

//declareer en initiëer Session-variabelen
$html = "";
$_SESSION["zoekResultaten"] = "";

//maak  html-variabele van dbStatement
while ($row = $data->fetch()) {
    $html .=
        "<article> 
            <h2>$row[naam] </h2>
            <img src='./images/$row[afbeelding]' alt='fiets of accessoire'>
            <p>$row[omschrijving]</p>
            <p><strong>$row[prijs]</strong></p> 
            <p>Voorraad:  $row[voorrad]</p>
                <form action=includes/shoppingcartBewerkenItem.php method='post'>
                    <input type=hidden id=rowNummer name=rowNummer value=$row[nummer]>
                    <input type='submit' name=toevoegenAanShoppingCart value=Toevoegen>
                </form>
        </article>";

    $_SESSION['rowNummer'] = $row['nummer'];
    $_SESSION["zoekResultaten"] = $html;
}