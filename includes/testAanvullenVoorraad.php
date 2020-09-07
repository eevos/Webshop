<?php
include "../functions/functions.php";

Database::initialize();

$dbStatement = Database::$conn->prepare("SELECT * FROM producten");
$dbStatement->execute();
$data = $dbStatement;

while ($row = $data->fetch()) {
    echo $i = $row['nummer'];
    $dbUpdateStatement = Database::$conn->prepare("UPDATE producten set voorrad = 5 where nummer = $i");
    $dbUpdateStatement->execute();
}

header("Location: ../test.php");