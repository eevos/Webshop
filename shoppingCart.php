<?php
include "includes/header.php";
include "functions/functions.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();}

?>
    <main>
        <section>
            <?php
            if (!isset($_SESSION['welkomstBericht'])) {
                echo makeArticle(
                        "Probleem","Je bent niet ingelogd. Log in om verder te gaan en je winkelwagen te vullen.",
                        null);
            } else {
                if (empty($_SESSION['itemsShoppingCart'])&& !$_SESSION['afgerekend'])  {
                    echo makeArticle("Winkelwagen","Je winkelwagentje is nog leeg.", null);
                }
                if (!empty($_SESSION['itemsShoppingCart']) && !$_SESSION['afgerekend']) {
                    echo makeArticle(null, makeLink("assortiment.php", "Terug naar assortiment"), "button");
                    echo makeHtmlShoppingCart($_SESSION['itemsShoppingCart']);
                    echo "winkelwagen";
                }
                if ($_SESSION['afgerekend'] ||(empty($_SESSION['itemsShoppingCart'])&& $_SESSION['afgerekend'])) {
                    echo makeArticle("Succes!", "Je hebt afgerekend!", null);
                    $_SESSION['afgerekend'] = false;
                }
            }
            ?>
        </section>
    </main>
<?php
    include "includes/footer.php";