<?php
include "includes/header.php";
include "functions/functions.php";

if (empty($_SESSION['gebruikersnaam']))
    if (empty($_SESSION['foutmeldingen'])) {
        $contents = include "includes/signupFormulier.php";
        makeMainSection(makeArticle(
            "Signup", $contents, null
            )
        );
    } else {
    echo makeLink("signup.php", "Terug naar Signup");

        echo makeMainSection(makeArticle(
                "Foutje!",
                "Het formulier is niet compleet : "
                . "<br>" .
                $_SESSION['foutmeldingen'],
                null)
        );
        $_SESSION['foutmeldingen'] = null;
    } else {

    echo makeMainSection(makeArticle(
            "Welkom!",
            "Je bent nu ingelogd. Je moet eerst uitloggen om in te kunnen schrijven.",
            null)
    );
}

include "includes/footer.php";