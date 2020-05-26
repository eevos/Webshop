<?php
session_start();

//    if (($key = array_search($_POST['rowNummer'], $_SESSION['itemsShoppingCart'])) !== false) {
//        unset($_SESSION['itemsShoppingCart'][$key]);
//    }
$_SESSION['test'] = null;
$_SESSION['test'] = "shoppingCartVerwijderenItem.php wordt geactiveerd";
$_SESSION['test'] .= $_POST['rowNummer'];

//$_SESSION['itemsShoppingCart'] = null;
//$_SESSION['htmlShoppingCart'] = null;
//$_SESSION['itemsShoppingCart'] = [1, 2];


header("Location: ../shoppingCart.php");
