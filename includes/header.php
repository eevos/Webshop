<?php session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Webshop</title>
    <link rel='stylesheet' href='css/styles1.css'/>
    <meta name="viewport" content="width=device-width, initial scale=1.0, maximum-scale=1.0"/>
</head>
<body>

<div class="menuheader">
    <nav>
        <p class="menutitle">Menu</p>
        <ul class="menucontent">
            <div class='logo'>
                <img src="images/small/logofiets.jpg" alt="logofiets"/>
            </div>
            <li class='home'><a href="index.php">Home</a></li>
            <li class='assortiment'><a href="assortiment.php"><span>Assortiment &#x25BE</span></a>
                <ul class="assortiment-menu">

                    <form action="./includes/zoekResultaten.php">
                        <!--                        <input type="hidden" id="categorie" name="categorie" value="kinderfietsen">-->
                        <input type="submit" name="typeFiets" value="kinderfietsen">
                        <input type="submit" name="typeFiets" value="damesfietsen">
                        <input type="submit" name="typeFiets" value="herenfietsen">
                        <input type="submit" name="typeFiets" value="elektrisch">
                        <input type="submit" name="typeFiets" value="accessoires">
                        <input type="submit" name="prijs" value=">500">
                        <input type="submit" name="prijs" value="<500">
                        <input type="submit" name="voorraad" value="op voorraad">


                    </form>


                    <!--                    <li>Overzicht</li>-->
                    <!--                    <li>Kinderfietsen</li>-->
                    <!--                    <li>Herenfietsen</li>-->
                    <!--                    <li>Damesfietsen</li>-->
                    <!--                    <li>Elektrische fietsen</li>-->
                    <!--                    <li>Bakfietsen</li>-->
                </ul>
            </li>
            <li><a href="voorwaarden.php">Voorwaarden</a></li>
            <li><a href="contactFormulier.php">Contact</a></li>
            <li><a href="shoppingCart.php">Winkelwagen</a></li>
            <li><a href="signup.php">Signup</a></li>
            <li><a href="login.php">
                    <?php
                    if (!isset($_SESSION['gebruikersnaam'])) {
                        echo "Inloggen";
                    } else {
                        echo $_SESSION['gebruikersnaam'], " uitloggen";
                    }
                    ?>
                </a>
                <!--                <div class="inloggen">-->
                <!--                    --><?php //include "includes/zoekFormulier.php"; ?>
                <!--                </div>-->
            </li>
        </ul>
    </nav>

    <header>
        <div class='header'>
            <div class='subscribe'>Subscribe</div>

            <div class='social'>Logo's van Social Media</div>
        </div>
    </header>
</div>