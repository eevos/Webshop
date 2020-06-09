<?php
session_start();

require "connectToDatabase.php";

//initialize $ declare sql-parts
$where = "";
$sqlWhere = "";
$voorraad = "";
$categorie ="";
$prijs = "";

//In header staat "op voorraad" -> wijzigen naar >0 ivm database.
if ($_GET['voorraad'] == "op voorraad"){$_GET['voorraad'] = ">0";};

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

//declareer en initiëer Session-variabelen
$html = "";
$_SESSION["zoekResultaten"] = "";

//maak  html-variabele van dbStatement
while ($row = $data->fetch()) {
    $html .=
        "<article class='zoekresultaten'> 
            <h2>$row[naam] </h2>
            <img src='./images/$row[afbeelding]' alt='fiets of accessoire'>
            <p>$row[omschrijving]</p>
            <p><strong>$row[prijs]</strong></p> 
            <p>Voorraad:  $row[voorrad]</p>
                <form action=includes/shoppingcartBewerkenItem.php class='winkelwagenbutton' method='post'>
                    <input type=hidden id=rowNummer name=rowNummer value=$row[nummer]>
                    <input type='submit' name=toevoegenAanShoppingCart value=Toevoegen>
                </form>
        </article>";

    $_SESSION['rowNummer'] = $row['nummer'];
    $_SESSION["zoekResultaten"] = $html;
}
?>

<?php
header("Location: ../assortiment.php");
?>

