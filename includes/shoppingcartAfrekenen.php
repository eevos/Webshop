<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//make connection to DB
$_SESSION['itemsShoppingcart'] = [4, 5, 6, 4];
echo "ShoppingcartAfrekenen.php wordt aangeroepen";
//echo(var_dump($_SESSION['itemsShoppingcart']));

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

for ($i = 0; $i < sizeof($_SESSION['itemsShoppingcart']); $i++) {
    $productnummer = $_SESSION['itemsShoppingcart'][$i];

    $dbStatement = $dbh->prepare("SELECT * FROM producten WHERE NUMMER = $productnummer");
    $dbStatement->execute();
    $data = $dbStatement;

//make sql query to adapt voorraad
    while ($row = $data->fetch()) {
        $voorraad[$i] = $row['voorrad'];
//        echo $i . " --> " . $row['voorrad'] . " , ";

        $voorraad[$i] -= 1;

        $query = "UPDATE producten set voorrad = $voorraad[$i] where nummer = $productnummer";

        $dbRemoveStatement = $dbh->prepare($query);
        $dbRemoveStatement->execute();
    }
}
//echo  "Shopping cart is afgerekend";
//$_SESSION['test'] = "shoppingcartAfrekenen.php werkt.";
//$_SESSION['test'] = "Gefeliciteerd! Je winkelwagentje is afgerekend.";
$_SESSION['afgerekend'] = true;

header("Location: ../shoppingCart.php");