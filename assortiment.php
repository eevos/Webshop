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
                echo $_SESSION['zoekResultaten'];
                $_SESSION['zoekResultaten'] ="";

            } elseif (isset($_POST['reset'])){
//} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reset'])){
                $_SESSION['zoekResultaten'] ="";
                echo "Welkom! Voer het zoekformulier in om hier zoekresultaten te ontvangen.";
            } else {
                echo "Welkom! Voer het zoekformulier in om hier zoekresultaten te ontvangen.";
            }
            ?>
        </section>
    </main>

<?php include "includes/footer.php"; ?>