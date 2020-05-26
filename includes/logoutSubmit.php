<?php
session_start();
session_destroy();
$_SESSION['htmlShoppingCart'] = "";

//echo "submitlogout";
header("Location: ../login.php");
