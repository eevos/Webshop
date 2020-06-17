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

function makeArticle($title, $contents, $class)
{
    if ($title == null) {
        $html =
            "<article class='$class'>
                <p>$contents</p>
            </article>";
    } else {
        $html =
            "<article class='$class'>
                <h1>$title</h1>
                <p>$contents</p>
            </article>";
    }
    return $html;
}

function makeLink($location, $omschrijving)
{
    $html = "<a href=$location>$omschrijving</a> <br>";
    return $html;
}

function fillIndex($html)
{
    $htmlArticles = "";
    for ($i = 0; $i < count($html); $i++) {
        $htmlArticles .= makeArticle($html[$i]["htmlTitle"], $html[$i]["htmlContents"], null);
    }
    return makeMainSection($htmlArticles);
}

function displayShoppingCart($contents)
{
    echo makeArticle("Winkelwagen", $contents, null);
}

function getDataAndShowItems($dbData)
{
    $html = "";
    $_SESSION["zoekResultaten"] = "";

    while ($row = $dbData->fetch()) {
        $rowNaam = $row['naam'];
        $rowAfbeelding = $row['afbeelding'];
        $rowOmschrijving = $row['omschrijving'];
        $rowPrijs = $row['prijs'];
        $rowVoorraad = $row['voorrad'];
        $rowNummer = $row['nummer'];

        $html .=
            makeArticleItemZoekResultaten($rowNaam, $rowAfbeelding, $rowOmschrijving, $rowPrijs, $rowVoorraad, $rowNummer);
        $_SESSION['rowNummer'] = $row['nummer'];
        $_SESSION["zoekResultaten"] = $html;
    }
}

function makeArticleItemZoekResultaten($rowNaam, $rowAfbeelding, $rowOmschrijving, $rowPrijs, $rowVoorraad, $rowNummer)
{
    if ($rowVoorraad > 0) {
        $html =
            "<article class='zoekresultaten'> 
                <h2>$rowNaam </h2>
                <img src='./images/$rowAfbeelding' alt='fiets of accessoire'>
                <p>$rowOmschrijving</p>
                <p><strong>$rowPrijs</strong></p> 
                <p>Voorraad:  $rowVoorraad</p>
                    <form action=includes/shoppingcartBewerkenItem.php class='winkelwagenbutton' method='post'>
                        <input type=hidden id=rowNummer name=rowNummer value=$rowNummer>
                        <input type='submit' name=toevoegenAanShoppingCart value=Toevoegen>
                    </form>
                    <form action=./includes/zoekResultaten.php class='winkelwagenbutton' method='post'>
                        <input type=hidden id=rowNummer name=rowNummer value=$rowNummer>
                        <input type='submit' name=bekijkenItem value=Bekijken>
                    </form>
            </article>";
    } else {
        $rowVoorraad = "Niet leverbaar.";
        $html =
            "<article class='zoekresultaten'> 
                <h2>$rowNaam </h2>
                <img src='./images/$rowAfbeelding' alt='fiets of accessoire'>
                <p>$rowOmschrijving</p>
                <p><strong>$rowPrijs</strong></p> 
                <p>Voorraad:  $rowVoorraad</p>
                    <form action=./includes/zoekResultaten.php class='winkelwagenbutton' method='post'>
                        <input type=hidden id=rowNummer name=rowNummer value=$rowNummer>
                        <input type='submit' name=bekijkenItem value=Bekijken>
                    </form>
            </article>";
    }
//    $html =
    return $html;
}


function makeArticleTotalePrijs($totalePrijs)
{
    $html =
        "<article class='totalePrijs'>
            <h2>Totale prijs : </h2>
            <p>De totale prijs van de gekozen producten bedraagt :
            <span><strong>€ $totalePrijs</strong></span>
            </p>
        </article>";
    return $html;
}

function makeArticleItemShoppingCart($row)
{
    $html =
        "   <img src='./images/small/$row[afbeelding]' alt='fiets'>
            <p>$row[omschrijving]</p>
            <p><strong>$row[prijs]</strong></p> 
            <p>Voorraad:  $row[voorrad]</p>
                <form action=./includes/shoppingcartBewerkenItem.php class='winkelwagenbutton' method='post'>
                    <input type=hidden id=rowNummer name=rowNummer value=$row[nummer]>
                    <input type='submit' name=verwijderenUitShoppingCart value=Verwijderen>
                </form>
         ";
    $html = makeArticle($row['naam'], $html, "itemShoppingCart");
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
        $htmlAfgerekend .= makeArticle("Succes! ", "Je hebt afgerekend.", null);
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

    $htmlButtonsShoppingCart = makeButtonShoppingCart();
    $htmlButtonsShoppingCart .= makeButtonEmptyShoppingCart();
    $htmlButtonsShoppingCart = makeArticle(null, $htmlButtonsShoppingCart, "button");

    $html .= $htmlAfgerekend;
    $html .= $htmlTotalePrijs;
    $html .= $htmlItemsShoppingCart;
    $html .= $htmlButtonsShoppingCart;
    //    $html .= $htmlButtonShoppingCart;
//    $html .= $htmlButtonEmptyShoppingCart;

    return $html;
}

function makeButtonShoppingCart()
{
    $html =
        "
   <form action=./includes/shoppingcartAfrekenen.php class='winkelwagenbutton' method='post'>
        <input type='submit' name=shoppingcartAfrekenen value=shoppingcartAfrekenen>
    </form>    
    ";
    return $html;
}

function makeButtonEmptyShoppingCart()
{
    $html =
        "
   <form action=./includes/shoppingcartBewerkenItem.php class='winkelwagenbutton' method='post'>
        <input type='submit' name=leegmakenShoppingcart value=leegmakenShoppingcart>
    </form>    
    ";
    return $html;
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

//$_SESSION['gebruikersNaam'] = "harry";
//$_SESSION['itemsShoppingCart'] = [2, 3, 4, 5, 6];
//session_destroy();

function insertBestellingDB($gebruikersnaam, $items)
{
    $serializedItems = serialize($items);

    try {
        $dbh = new PDO(
            'mysql:host=localhost;
        dbname=webshop',
            "root",
            "");
    } catch (Exception $e) {
        echo "Er is iets fout gegaan met de verbinding.";
    }
    $dbStatement = $dbh->prepare(
        "INSERT INTO bestellingen ( gebruikersnaam, bestellingSerialized)
                VALUES ( '$gebruikersnaam','$serializedItems') ");
    $dbStatement->execute();
}

//insertBestellingDB($_SESSION['gebruikersNaam'], $_SESSION['itemsShoppingCart']);

function getLaatsteBestellingDB($gebruikersnaam)
{
    try {
        $dbh = new PDO(
            'mysql:host=localhost;
        dbname=webshop',
            "root",
            "");
    } catch (Exception $e) {
        echo "Er is iets fout gegaan met de verbinding.";
    }
    $dbStatement = $dbh->prepare(
        "SELECT * FROM bestellingen WHERE gebruikersnaam = '$gebruikersnaam' 
                AND bestellingId IN 
                (SELECT max(bestellingId) from bestellingen WHERE gebruikersnaam = '$gebruikersnaam')
                ");
    $dbStatement->execute();
    $data = $dbStatement;
    while ($row = $data->fetch()) {
        return unserialize($row['bestellingSerialized']);
    }
}

//HAAL BESTElling uit DB
//var_dump(getLaatsteBestellingDB("susantigoon"));

//maak nu een samenvatting voor de footer.
function makeArticleLaatsteBestelling($itemsInBestelling)
{
    $htmlLaatsteBestelling = "  <h4>Je laatste bestelling:</h4>
                                <ul class='footer'>";
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
    foreach ($itemsInBestelling as $itemNummer) {
        //zoek itemNummer op in db
        $dbStatement = $dbh->prepare("SELECT * FROM producten WHERE nummer = $itemNummer");
        $dbStatement->execute();
        $data = $dbStatement;
        //ieder itemnummer wordt aan de footer-article toegevoegd
        while ($row = $data->fetch()) {
            $htmlLaatsteBestelling .= "
            <li>
            $row[naam];
            </li>
            ";
            $totalePrijs = $totalePrijs + $row['prijs'];
        }
    }

    $htmlLaatsteBestelling .= "</ul>";
    $htmlTotalePrijs =  "De totale prijs van je vorige bestelling : € " . $totalePrijs;
    $htmlLaatsteBestelling .= $htmlTotalePrijs;

    return $htmlLaatsteBestelling;
}

//var_dump((getLaatsteBestellingDB("harry")));
//echo makeArticleLaatsteBestelling(getLaatsteBestellingDB("harry"));
//<img src='./images/small/$row[afbeelding]' alt='fiets'>