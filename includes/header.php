<?php session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Webshop</title>
    <link rel='stylesheet' href='css/styles.css'/>
    <meta name="viewport" content="width=device-width, initial scale=1.0, maximum-scale=1.0"/>
</head>
<body>

<div class="menuheader">
    <nav>
        <p> <a href="" class="menutitle">Menu</a></p>
        <ul class="menucontent">
            <div class='logo'>
                <a href="index.php"><img src="images/small/logo.png" alt="logofiets"/> </a>
            </div>
            <li class='home'><a href="index.php">Home</a></li>
            <li class='assortiment'><a href="assortiment.php"><span>Assortiment &#x25BE</span></a>
                <ul class="assortiment-menu">
                    <form action="./includes/zoekResultaten.php">
                        <li><input type="submit" class= "headerbutton" name="typeFiets" value="kinderfietsen"></li>
                        <li><input type="submit" class= "headerbutton" name="typeFiets" value="damesfietsen"></li>
                        <li><input type="submit" class= "headerbutton" name="typeFiets" value="herenfietsen"></li>
                        <li><input type="submit" class= "headerbutton" name="typeFiets" value="elektrisch"></li>
                        <li><input type="submit" class= "headerbutton" name="typeFiets" value="accessoires"></li>
                        <li><input type="submit" class= "headerbutton" name="prijs" value=">500"></li>
                        <li><input type="submit" class= "headerbutton" name="prijs" value="<500"></li>
                        <li><input type="submit" class= "headerbutton" name="voorraad" value="op voorraad"></li>
                    </form>
                </ul>
            </li>
            <li><a href="voorwaarden.php">Voorwaarden</a></li>
            <li><a href="contactFormulier.php">Over ons</a></li>
            <li><a href="shoppingCart.php">Winkelwagen</a></li>
            <li><a href="login.php">
                    <?php
                    if (!isset($_SESSION['gebruikersnaam'])) {
                        echo "Inloggen";
                    } else {
                        echo $_SESSION['gebruikersnaam'], " uitloggen";
                    }
                    ?>
                </a>
            </li>
        </ul>
    </nav>

    <header>
        <div class='header'>
            <div class='subscribe'><a href="signup.php">Signup</a></div>
            <div class='social'>
                <a href="https://www.w3schools.com/html/html_links.asp">
                    <img src="./images/small/google.png">
                </a>
                <a href="https://www.volkskrant.nl">
                    <img src="./images/small/fb.png">
                </a>
            </div>
        </div>
    </header>
</div>