<?php
session_start();

require_once "../functions/functions.php";
Database::initialize();

$foutmeldingenlogin = "";
$sqlgebruikersnaam = "";
$sqlwachtwoord = "";

$htmlwelkom = "";
$sqlvoornaam = "";
//$_POST['submitLogin'] = true;
//$_POST['gebruikersnaam'] = "AT";
//$_POST['wachtwoord'] = "eee";

if (isset($_POST['submitLogin'])) {
    echo "submitlogin ontvangen";
//    require 'connectToDatabase.php';

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

        $dbStatement = Database::$conn->query(
            "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaamlogin' ");
//        $dbStatement->execute();
        $data = $dbStatement;

//        $data =
//            $dbh->query("
//            SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaamlogin'
//            ");

        while ($row = $data->fetch()) {
            $sqlgebruikersnaam = $row['gebruikersnaam'];
            $sqlwachtwoord = $row['wachtwoord'];
            $sqlvoornaam = $row['voornaam'];
            $_SESSION['voornaam'] = $sqlvoornaam;
            echo $sqlgebruikersnaam . $sqlwachtwoord;
//            echo "heeft data opgehaald" .  $_SESSION['voornaam'];
        }

        //controleren of inloggegevens overeenkomen met databasegegevens:
        if ($_POST['gebruikersnaam'] == $sqlgebruikersnaam && $_POST['wachtwoord'] == $sqlwachtwoord) {
            $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
            $_SESSION['welkomstBericht'] = "Welkom $_SESSION[voornaam], je bent nu ingelogd!";
            header("Location: ../login.php");
        } else {
//            echo "<article>echo: Je hebt een onjuiste gebruikersnaam of wachtwoord ingevoerd.</article>";
            $_SESSION['welkomstBericht'] = "Je hebt een onjuiste gebruikersnaam of onjuist wachtwoord ingevoerd.";
            $_SESSION['gebruikersnaam'] = null;
            header("Location: ../login.php");
        }
    };
}
