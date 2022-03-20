<?php
function getDB()
{
    $host = "localhost";
    $dbname = "projtm";
    $user = "root";
    $pass = "";

    try {
        $bdd = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);
    } catch (Exception $e) {
    }
    return $bdd;
}
