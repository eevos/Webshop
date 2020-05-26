<?php
try {
    $dbh = new PDO(
        'mysql:host=localhost; 
        dbname=webshop',
        "root",
        "");
//    echo "Ik heb verbinding";
} catch (Exception $e) {
    echo "Er is iets fout gegaan met de verbinding.";
}