<?php
session_start();

function makeArticle($contents)
{
    $html = "<article>$contents</article>";
    return $html;
}
function displayShoppingCart($contents)
{
    echo makeArticle($contents);
}
function makeArticleTotalePrijs($totalePrijs)
{
    $html =
"<article class='totalePrijs'>
            <h2>Totale prijs : </h2>
            <p>De totale prijs van de gekozen producten bedraagt : </p>
            <br>
            <p>€ $totalePrijs</p>
        </article>";
    return $html;
}
function makeArticleItemShoppingCart($row)
{
    $html =
        "<article> 
                    <h2>$row[naam] </h2>
                    <img src='./images/$row[afbeelding]' alt='fiets'>
                    <p>$row[omschrijving]</p>
                    <p><strong>$row[prijs]</strong></p> 
                    <p>Voorraad:  $row[voorrad]</p>
                        <form action=./includes/shoppingcartBewerkenItem.php method='post'>
                            <input type=hidden id=rowNummer name=rowNummer value=$row[nummer]>
                            <input type='submit' name=verwijderenUitShoppingCart value=Verwijderen>
                        </form>
                </article>";
    return $html;
}
function makeHtmlShoppingCart($itemsShoppingCart)
{
    $html = "";
    $htmlItemsShoppingCart = "";
    $htmlButtonShoppingCart = "";
    $totalePrijs = 0;

    try {
        $dbh = new PDO(
            'mysql:host=localhost; 
        dbname=webshop',
            "root",
            "");
    } catch (Exception $e) {
        echo "Er is iets fout gegaan met de verbinding.";
    }

    foreach ($itemsShoppingCart as $itemNummer) {
        //zoek itemNummer op in db
        $dbStatement = $dbh->prepare("SELECT * FROM producten WHERE nummer = $itemNummer");
        $dbStatement->execute();
        $data = $dbStatement;
        //ieder itemnummer stop je in een article
        while ($row = $data->fetch()) {         //while hoeft niet bij 1 itemnummer
            $totalePrijs = $totalePrijs + $row['prijs'];
            $htmlItemsShoppingCart .= makeArticleItemShoppingCart($row);
        }
    }
    $htmlTotalePrijs = makeArticleTotalePrijs($totalePrijs);
    $htmlButtonShoppingCart = makeButtonShoppingCart($_SESSION['itemsShoppingCart']);

    $html .= $htmlTotalePrijs;
    $html .= $htmlItemsShoppingCart;
    $html .= $htmlButtonShoppingCart;
    return $html;
}

function makeButtonShoppingCart()
{
    //make button that uses function removeItemsFromStock()
    $html =
    "
   <form action=removeItemsFromStock() method='post'>
        <input type=hidden id=itemsShoppingcart name=itemsShoppingcart value=$_SESSION[itemsShoppingcart]>
        <input type='submit' name=removeItemsFromStock value=Afrekenen>
    </form>    
    ";
    return $html;
}

function removeItemsFromStock()
{
    //make connection to DB
    //make sql query to get voorraad from the $_SESSION['itemsShoppingcart']
        //for-loop
        // $voorraad = $row[ voorraad]
                // $voorraad -= 1;
                    //make sql query to set voorraad
                        // $sqlQuery = set voorraad = $voorraad where productnummer = $row[productnummer]
    //execute $sqlQuery
}

function forLoopArray($items, $inputhtml)
{
    $outputhtml = "<br> Contents of the array : <br>";
    for ($i = 0; $i < count($items); $i++) {
        $inputhtml .= $i . " => " . $items[$i] . "<br>";
    }
    $outputhtml = $inputhtml;
    return $outputhtml;
}
function removeItemShoppingcart($items, $clickedItem)
{
    for ($i = 2; $i > -1; $i--) {
        if ($items[$i] == $clickedItem) {
            array_splice($items, $i, 1);
        }
    }
    return $items;
}
