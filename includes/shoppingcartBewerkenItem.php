<?php
session_start();
include "../functions/functions.php";

if (isset($_POST['toevoegenAanShoppingCart'])) {
    $_SESSION['itemsShoppingCart'][] .= $_POST['rowNummer'];
}
if (isset($_POST['verwijderenUitShoppingCart'])) {
    $_SESSION['itemsShoppingCart'] = removeItemShoppingcart($_SESSION['itemsShoppingCart'], $_POST['rowNummer']);
//    $_POST['rowNummer'] = null;
}
if (isset($_POST['leegmakenShoppingcart'])) {
    $_SESSION['itemsShoppingCart'] = null;
}
header("Location: ../shoppingCart.php");
