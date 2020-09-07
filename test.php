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
                <h1>Doornemen krantenkoppen</h1>
                <p>Druk op deze knop en zie de krantenkoppen verschijnen die vandaag in het nieuws zijn.</p>
                <form action="test.php" class='' method='post'>
                    <input type='submit' name=leesKrant value=Lees>
                </form>
                <p>hieronder verschijnt leesKrant.php</p>

                <?php
                if (isset($_POST['leesKrant'])) {
                    echo file_get_contents("http://www.nu.nl");
                }

                ?>


                <!--                --><? // if (!isset($_SESSION['krant'])){
                //                    echo "leesKrant.php";
                //                    echo $_SESSION['krant'];
                //                    $_SESSION['krant']=null;
                //                }
                //
                ?>


            </article>
        </section>
    </main>


<?php endif;


include "includes/footer.php"; ?>