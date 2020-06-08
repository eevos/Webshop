<main>
    <section>
        <article>
            <h1>Logout</h1>

            <p>
                <?=
                $_SESSION['welkomstBericht'];
                ?>
            </p>

            <form action="includes/logoutSubmit.php" method="post">
                <button type="submit" name="logoutSubmit">
                    Logout
                </button>

            </form>
        </article>
    </section>
</main>