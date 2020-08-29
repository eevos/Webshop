<?php
include "./functions/functions.php";

$contents = "Klik hieronder om uit te loggen";
$contents .= " <form action=\"includes/logoutSubmit.php\" method=\"post\">
                <button type=\"submit\" name=\"logoutSubmit\">
                    Logout
                </button>";

echo makeMainSection(makeArticle(
    "Logout",
    $contents,
    null))

?>