<?php session_start();

$_SESSION['test'] = null;
$_SESSION['test'] = "shoppingCartToevoegenItem.php wordt nog eens geactiveerd";

$_SESSION['itemsShoppingCart'][] .= $_POST['rowNummer'];

//    $_SESSION['itemsShoppingCart'][] = [3, 4, 5];
//$_SESSION['itemsShoppingCart'] = null;

header("Location: ../shoppingCart.php");
