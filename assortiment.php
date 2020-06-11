<?php
include "includes/header.php";
include "functions/functions.php";
?>
    <main>
        <aside class="keuzemenu">
            <?php include "includes/zoekFormulier.php" ?>
        </aside>

        <section class="resultaten">
            <?php
            if (!empty($_SESSION["zoekResultaten"])) {
                echo makeArticle(null,makeLink("assortiment.php", "Terug naar assortiment"),"button");

                echo $_SESSION['zoekResultaten'];
                $_SESSION['zoekResultaten'] = "";
            } elseif (isset($_POST['reset'])) {
//} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reset'])){
                $_SESSION['zoekResultaten'] = "";
                echo "Welkom! Voer het zoekformulier in om hier zoekresultaten te ontvangen.";
            }
            else {
                require "includes/connectToDatabase.php";
                $dbStatement = $dbh->prepare("SELECT * FROM producten");
                $dbStatement->execute();
                $dbData = $dbStatement;
                getDataAndShowItems($dbData);
                echo $_SESSION['zoekResultaten'];
                $_SESSION['zoekResultaten'] = "";
            }
            ?>
        </section>
    </main>

<?php include "includes/footer.php"; ?>