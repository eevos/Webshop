<?php
session_start();

$foutmeldingenlogin = "";
$sqlgebruikersnaam = "";
$sqlwachtwoord = "";

$htmlwelkom = "";
$sqlvoornaam = "";


if (isset($_POST['submitLogin'])) {
    echo "submitlogin ontvangen";
    require 'connectToDatabase.php';

    $gebruikersnaamlogin = $_POST['gebruikersnaam'];
    $wachtwoordlogin = $_POST['wachtwoord'];

    //controleer op lege velden
    if (empty($_POST['gebruikersnaam'])) {

        $foutmeldingenlogin .= "<li>Gebruikersnaam is leeg.</li>";
        echo $foutmeldingenlogin;

    } else if (empty($_POST['wachtwoord'])) {

        $foutmeldingenlogin .= "<li>Wachtwoord is leeg.</li>";
        echo $foutmeldingenlogin;

        //als er geen lege velden zijn kun je verder in de database
    } else {

        $data =
            $dbh->query("
            SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaamlogin' 
            ");

        while ($row = $data->fetch()) {

            $sqlgebruikersnaam = $row['gebruikersnaam'];
            $sqlwachtwoord = $row['wachtwoord'];
            $sqlvoornaam = $row['voornaam'];
            $_SESSION['voornaam'] = $sqlvoornaam;
            echo "heeft data opgehaald";
        }

        //controleren of inloggegevens overeenkomen met databasegegevens:
        if ($_POST['gebruikersnaam'] == $sqlgebruikersnaam && $_POST['wachtwoord'] == $sqlwachtwoord) {
            $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
            $htmlwelkom = " 
                    Welkom $_SESSION[voornaam], je bent nu ingelogd! 
                ";
            $_SESSION['welkomstBericht'] = $htmlwelkom;
            header("Location: ../login.php");
        } else {
            echo "<article>echo: Je hebt een onjuiste gebruikersnaam of wachtwoord ingevoerd.</article>";
            $htmlwelkom = "Je hebt een onjuiste gebruikersnaam of onjuist wachtwoord ingevoerd.";
            $_SESSION['welkomstBericht'] = $htmlwelkom;
            $_SESSION['gebruikersnaam'] = null;
//            header("Location: ../login.php");
        }
    };
}
