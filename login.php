<?php
include "includes/header.php";
//include "functions/functions.php";

if (!isset($_SESSION['welkomstBericht']) && empty($_SESSION['gebruikersnaam'])) {

    include "includes/loginFormulier.php";

} elseif (isset($_SESSION['welkomstBericht']) && empty($_SESSION['gebruikersnaam'])) {
    include "functions/functions.php";

    echo makeArticle("Oeps",
        "Je hebt geen geldige combinatie gebruikersnaam / wachtwoord ingevoerd.",
        null);
    $_SESSION['welkomstBericht'] = null;
} else {
    $_SESSION['welkomstBericht'] = null;
    include "includes/logoutFormulier.php";
}

include "includes/footer.php";
