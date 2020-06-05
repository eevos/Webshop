<?php
//session_destroy();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$_SESSION['test'] = null;


function makeMainSection($contents)
{
    $html = "<main><section>$contents</section></main>";
    return $html;
}

function makeArticle($title, $contents)
{
    $html =
        "<article>
            <h1>$title</h1>
                <p>$contents</p>
        </article>";
    return $html;
}

function makeLink($location, $omschrijving)
{
    $html="<a href=$location>$omschrijving</a> <br>";
    return $html;
};
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

if (!isset($_SESSION['afgerekend'])) {
    $_SESSION['afgerekend'] = null;
}

function makeHtmlShoppingCart($itemsShoppingCart)
{
    $html = "";
    $htmlItemsShoppingCart = "";
    $htmlButtonShoppingCart = "";
    $htmlButtonEmptyShoppingCart = "";
    $totalePrijs = 0;
    $htmlAfgerekend = null;
    if ($_SESSION['afgerekend'] == true) {
        $htmlAfgerekend .= makeArticle("Je hebt afgerekend.");
        $_SESSION['afgerekend'] = false;
    }

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
    $htmlButtonShoppingCart = makeButtonShoppingCart();
    $htmlButtonEmptyShoppingCart = makeButtonEmptyShoppingCart();

    $html .= $htmlAfgerekend;
    $html .= $htmlTotalePrijs;
    $html .= $htmlItemsShoppingCart;
    $html .= $htmlButtonShoppingCart;
    $html .= $htmlButtonEmptyShoppingCart;

    return $html;
}

//$_SESSION['itemsShoppingcart'] = [4, 5, 6, 4];
//echo(makeButtonShoppingCart());

function makeButtonShoppingCart()
{
    //make button that executes shoppingcartAfrekenen.php
    $html =
        "
   <form action=./includes/shoppingcartAfrekenen.php method='post'>
        <input type='submit' name=shoppingcartAfrekenen value=shoppingcartAfrekenen>
    </form>    
    ";
    return $html;
}

function makeButtonEmptyShoppingCart()
{
    //make button that executes shoppingcartBewerkenItem.php
    $html =
        "
   <form action=./includes/shoppingcartBewerkenItem.php method='post'>
        <input type='submit' name=leegmakenShoppingcart value=leegmakenShoppingcart>
    </form>    
    ";
    return $html;
}

//function removeItemsFromStock()
//{
//    //make connection to DB
//    try {
//        $dbh = new PDO(
//            'mysql:host=localhost;
//        dbname=webshop',
//            "root",
//            "");
//    } catch (Exception $e) {
//        echo "Er is iets fout gegaan met de verbinding.";
//    }
//    //make sql query to get voorraad from the $_SESSION['itemsShoppingcart']
//    $dbStatement = $dbh->prepare("SELECT * FROM producten $sqlWhere");
//    $dbStatement->execute();
//    $data = $dbStatement;
//
//    while ($row = $data->fetch()) {
//        $html .=
//            "";
//    }
//        //for-loop
//        // $voorraad = $row[ voorraad]
//                // $voorraad -= 1;
//                    //make sql query to set voorraad
//                        // $sqlQuery = set voorraad = $voorraad where productnummer = $row[productnummer]
//    //execute $sqlQuery
//}

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
