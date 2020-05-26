<?php
//try {
//    $dbh = new PDO('mysql:host=localhost; dbname=webshop', "root", "");
//   echo "Ik heb verbinding";
//} catch (Exception $e) {
//    echo "Er is iets fout gegaan";
//}

$data = $dbh->query("SELECT * FROM PRODUCTEN where prijs < 500");

$html = "";

echo "<pre>";
while ($row = $data->fetch()) {
    $html .= "<article> <h2>$row[naam] </h2>
    <img src='images/$row[afbeelding]' alt='fiets'>
    <p>$row[omschrijving]</p>
    <p><strong>$row[prijs]</strong></p>
    </article>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulieren</title>
    <style>
        main {
            display: flex;
            flex-wrap: wrap;
        }
        article {
            width: 150px%;
            background-color: lightpink;
            margin: 5px;
            padding: 10px;
        }
        img {
            max-width: 100%;
        }
    </style>

</head>
<body>
<h1>Webshop</h1>

<main>

    <?= $html; ?>
</main>
</body>
</html>
