<?php
include "includes/header.php";
include "functions/functions.php";
include "functions/leesKrant.php";


if (isset($_SESSION['gebruikersnaam']) && $_SESSION['gebruikersnaam'] == "marjo"):?>

    <main>
        <section>
            <article>
                <h1>Testpagina</h1>
                <ol>
                    <li>Knop aanvullen voorraad in sql</li>
                    <li>PDO sql-injection tegengaan met prepared statements</li>
                    <li>Uitbreiden aanvullen voorraad met een plus en min-knop.</li>
                    <li>Maak een crawler die de voorpagina van nu.nl voor je leest.</li>
                </ol>
            </article>

            <article>
                <h1>Aanvullen voorraad</h1>
                <p>Je kunt de voorraad aanvullen tot 5 stuks per item met onderstaande knop.</p>
                <form action=includes/testAanvullenVoorraad.php class='' method='post'>
                    <input type='submit' name=testAanvullenVoorraad value=Aanvullen_Voorraad>
                </form>
                <p>Natuurlijk bouw ik dit uit met een + en -, misschien wel per item.</p>
            </article>

            <article>
                <h1>Doornemen krantenkoppen Volkskrant</h1>
                <p>Druk op deze knop en zie de krantenkoppen verschijnen die vandaag in het nieuws zijn.</p>
                <form action="test.php" class='' method='post'>
                    <input type='submit' name=leesKrant value=Lees>
                </form>
            </article>

            <?php

            if (isset($_POST['leesKrant'])) {
                $url = "https://www.volkskrant.nl/nieuws";
                echo makeArticle("$url ", leesKrant($url), "artikelen");
            }
            $_POST['leesKrant'] = null;
            ?>

            <article>
                <form action="solax.php" method="post">
                    Token: <input type="text" name="token"/><br/>
                    <input type="submit" name="submitSolax" value="Submit me!"/>
                </form>
            </article>
            <?php
            if (isset($_POST['submitSolax'])) {
                echo "test solax";
                echo $_SESSION["getSolaxInfo"];
                $_SESSION["getSolaxInfo"] = null;
            }
            ?>

        </section>
    </main>


<?php endif;


include "includes/footer.php"; ?>