<?php

//class Database
//{
//    private static $init = FALSE;
//    public static $conn;
//
//    public static function initialize()
//    {
//        self::$init = TRUE;
//        self::$conn = new PDO('mysql:host=localhost; dbname=webshop',"root", "");
//    }
//}
//Database::initialize();

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


