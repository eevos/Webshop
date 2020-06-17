<footer>

    <article class="footer">
        <h4>Contactgegevens: </h4>
        <p>
            Edwin<br>
            06-12345678<br>
            IBAN: BANK 1234560 <br>
            edwin@webshop.nl<br>
            www.edwinwebshops.nl
        </p>
    </article>

    <article class="footer">
        <p>
        <li class='date'>© 2019- <?php echo date("Y"); ?> </li>
        <li class='home'><a href="index.php">Home</a></li>
        <li><a href="voorwaarden.php">Voorwaarden</a></li>
        <li><a href="contactformulier.php">Contact</a></li>
        <li><a href="signup.php">Signup</a></li>
        <li><a href="login.php">Login</a></li>
        </p>
    </article>
    <article class="footer">
        <?php
        if (!empty($_SESSION['gebruikersnaam'])) {
            if (!empty(getLaatsteBestellingDB($_SESSION['gebruikersnaam']))) {
                echo makeArticleLaatsteBestelling(getLaatsteBestellingDB($_SESSION['gebruikersnaam']));
            }
        } else {
            echo "Je hebt nog geen bestellingen gedaan";
        };
        ?>

    </article>
</footer>