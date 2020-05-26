<?php
//session_start();

if (isset($_POST['submitsignup'])) {
    require 'connectToDatabase.php';

    //Ingevoerde gegevens als variabelen:
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $plaats = $_POST['plaats'];
    $telefoon = $_POST['telefoon'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    //variabelen om te zoeken naar lege velden:
    $foutmeldingen = "";
    $fout = $gebruikersnaam;

    //zoeken naar lege velden:
    switch ($fout) {
        case $gebruikersnaam:
            if (empty($gebruikersnaam)) {
                $foutmeldingen .= "<li> Gebruikersnaam is leeg </li> <br>";
            }
            $fout = $voornaam;
        case $voornaam:
            if (empty($voornaam)) {
                $foutmeldingen .= "<li> Voornaam is leeg </li> <br>";
            }
            $fout = $achternaam;
        case $achternaam:
            if (empty($achternaam)) {
                $foutmeldingen .= "<li> Achternaam is leeg </li> <br>";
            }
            $fout = $plaats;
        case $plaats:
            if (empty($plaats)) {
                $foutmeldingen .= "<li> Plaats is leeg </li> <br>";
            }
            $fout = $telefoon;
        case $telefoon:
            if (empty($telefoon)) {
                $foutmeldingen .= "<li> Telefoon is leeg </li> <br>";
            }
            $fout = $email;
        case $email:
            if (empty($email)) {
                $foutmeldingen .= "<li> Email is leeg </li> <br>";
            }
            $fout = $wachtwoord;
        case $wachtwoord:
            if (empty($wachtwoord)) {
                $foutmeldingen .= "<li> Wachtwoord is leeg </li> <br>";
            }

        //Als er geen fouten gevonden zijn volgt een SQL-INSERT-statement, anders wordt een lijst met fouten weergegeven.
        default:
            if (empty($foutmeldingen)) {
                $sql = $dbh->query(
                    "INSERT INTO gebruikers (gebruikersnaam, voornaam, 
                                achternaam, tussenvoegsel, plaats, telefoon, email, wachtwoord)
                                VALUES ('$gebruikersnaam', '$voornaam', 
                                '$achternaam', '$tussenvoegsel', '$plaats', '$telefoon', '$email', '$wachtwoord');
                    ");
                echo "Signup is gelukt! Je kunt nu inloggen.";
                header("Location: ../login.php");
                exit();
            } else {
                echo "<article><ul>" . $foutmeldingen . "</ul></article>";
            }
    }
}
