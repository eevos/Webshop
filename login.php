<?php
include "includes/header.php";

if (empty($_SESSION['gebruikersnaam'])) {

    include "includes/loginFormulier.php";

} else {

    include "includes/logoutFormulier.php";
}

include "includes/footer.php";
