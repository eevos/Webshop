<?php
session_start();
$_SESSION['itemsShoppingCart'] = [4,5,6];
$_POST['rowNummer'] = 5;

var_dump($_SESSION['itemsShoppingCart']);
echo "<br>";

//
//for ($i = 2; $i > -1; $i--) {
//    if ($_SESSION['itemsShoppingCart'][$i] == $_POST['rowNummer']) {
//        echo "item is same as rowNummer";
//        echo "<br>";
//            array_splice($_SESSION['itemsShoppingCart'],$i,1);
//    }
//}
function removeItemShoppingcart($items, $clickedItem)
{
    for ($i = 2; $i > -1; $i--) {
        if ($items[$i] == $clickedItem) {
            array_splice($items, $i, 1);
            return $items;
        }
    }
}
$_SESSION['itemsShoppingCart'] = removeItemShoppingcart([4,5,6], 5);
var_dump($_SESSION['itemsShoppingCart']);

//for($i = count($_SESSION['itemsShoppingCart']); $i > -1 ; $i--)
//{
//    echo $i . " => ". $_SESSION['itemsShoppingCart'][$i] . "<br>";
//}

//require 'includes/connectToDatabase.php';
//
//$dbStatement = $dbh->prepare("SELECT * FROM producten ");
//$dbStatement->execute();
//$data = $dbStatement;
//$html= "";
//
//while ($row = $data->fetch()){
//
//$html .= "$row[prijs] <br>";
//}
//
//echo $html;

//print_r(PDO::getAvailableDrivers());
//try {
//    $handler = new PDO('mysql:host=127.0.0.1;dbname=webshop', 'root', '');
//    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo $e->getMessage();
//    die();
//}
//
////$gebruikersnaam = $_POST['gebruikersnaam'];
////$voornaam = $_POST['voornaam'];
////$achternaam = $_POST['achternaam'];
////$tussenvoegsel = $_POST['tussenvoegsel'];
////$plaats = $_POST['plaats'];
////$telefoon = $_POST['telefoon'];
////$email = $_POST['email'];
////$wachtwoord = $_POST['wachtwoord'];
//
//$gebruikersnaam = 'JanKort';
//$voornaam = 'Jan';
//$achternaam = 'Korte';
//$tussenvoegsel = 'metde';
//$plaats = 'Kortdijk';
//$telefoon = '123445';
//$email = 'jankort.nl';
//$wachtwoord = 'kort';
//
////$sql = "INSERT INTO gebruikers (gebruikersnaam, voornaam, achternaam, tussenvoegsel, plaats, telefoon, email, wachtwoord)
////        VALUES ({$gebruikersnaam},{$voornaam},{$achternaam}, {$tussenvoegsel},{$plaats}, {$telefoon}, {$email}, {$wachtwoord})";
////$handler->query($sql);
//
//echo $gebruikersnaam, " has posted his credentials. Check mySQL table.";
//
////insert basismanier
//$sql = "INSERT INTO gebruikers (gebruikersnaam, voornaam, achternaam, tussenvoegsel, plaats, telefoon, email, wachtwoord)
//        VALUES ('{$gebruikersnaam}','Jan','Korte','met de','Kortdijk','12345', 'kort@lang.nl', 'kort')";
//$handler->query($sql);
//
//
////Get all results from table
//
////$query = $handler->query("SELECT * FROM gebruikers");
//
////$results = $query->fetchAll(PDO::FETCH_ASSOC);
////
////if (count($results)) {
////    echo "<pre>", print_r($results), "</pre>";
////} else {
////    echo "no resultes";
////}
//
