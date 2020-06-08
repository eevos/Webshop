<?php
include "includes/header.php";
include "functions/functions.php";
//$_SESSION['itemsShoppingCart'] = null;
//$_SESSION['itemsShoppingCart'] = [3,4,5];
//header("Refresh:0");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
    <a class="shoppingCart" href="index.php">Terug naar zoekpagina</a> <br>
    <main>
        <section>
            <?php
            if (!isset($_SESSION['welkomstBericht'])) {
                echo makeArticle("Je bent niet ingelogd. Log in om verder te gaan en je winkelwagen te vullen.");
            } else {
                if (!empty($_SESSION['itemsShoppingCart'])) {
//                    $_SESSION['test'] = "test";
//                    echo $_SESSION['test'];
                    $_SESSION['htmlShoppingCart'] = makeHtmlShoppingCart($_SESSION['itemsShoppingCart']);
                    echo $_SESSION['htmlShoppingCart'];
                } else {
                    echo makeArticle("Winkelwagen","Je winkelwagentje is nog leeg.");
                }
            }
            ?>
        </section>
    </main>
<?php include "includes/footer.php";
