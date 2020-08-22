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


//try {
//    $handler = new PDO(
//        'mysql:host=localhost; dbname=u62652p63191_edwinvos',
//        'u62652p63191_root',
//        'IlJeIBop');
//    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e){
//    echo $e->getMessage();
//    die();
//}