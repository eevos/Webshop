<?php
session_start();
session_destroy();
$_SESSION['htmlShoppingCart'] = "";

header("Location: ../login.php");
