<?php
include "./functions/functions.php";

$contents = $_SESSION['welkomstBericht'];
$contents .= " <form action=\"includes/logoutSubmit.php\" method=\"post\">
                <button type=\"submit\" name=\"logoutSubmit\">
                    Logout
                </button>";

echo makeMainSection(makeArticle("Logout", $contents, null))

?>