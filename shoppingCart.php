<?php
include "includes/header.php";
include "functions/functions.php";
//$_SESSION['itemsShoppingCart'] = null;
//$_SESSION['itemsShoppingCart'] = [3,4,5];

?>
    <a class="shoppingCart" href="index.php">Terug naar zoekpagina</a> <br>
    <main>
        <section>
            <?php
            if (!isset($_SESSION['htmlwelkom'])) {
                echo makeArticle("Je bent niet ingelogd. Log in om verder te gaan en je winkelwagen te vullen.");
            } else {
                if (!empty($_SESSION['itemsShoppingCart'])) {
//                    echo $_SESSION['test'];
                    $_SESSION['htmlShoppingCart'] = makeHtmlShoppingCart($_SESSION['itemsShoppingCart']);
                    echo $_SESSION['htmlShoppingCart'];
                } else {
                    echo makeArticle("Je winkelwagentje is nog leeg.");
                }
            }
            ?>
        </section>
    </main>
<?php include "includes/footer.html";
