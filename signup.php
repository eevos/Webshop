<?php
include "includes/header.php";

if (empty($_SESSION['gebruikersnaam'])) {

    include "includes/signupFormulier.html";

} else {

    echo "<main>
            <section>
                <article> 
                    <h1>" .
                    "Ingelogd" .
                    "</h1>" .
                    "Je moet eerst uitloggen om in te kunnen schrijven."
                . "</article>
            </section>
          </main>" ;
}

include "includes/footer.html";