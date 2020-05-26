<?php
include "includes/header.php";


if (empty($_SESSION['gebruikersnaam'])) {

    include "includes/loginFormulier.html";

} else {

    include "includes/logoutFormulier.php";
}

include "includes/footer.html";
