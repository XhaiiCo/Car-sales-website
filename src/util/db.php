<?php

$db;

function getDB()
{

    global $db;
    if ($db === null) {
        $host = "localhost";
        $dbname = "projtm";
        $user = "root";
        $pass = "";

        try {
            $bdd = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);
        } catch (Exception $e) {
        }
    }
    return $bdd;
}

function prepare($sql, $params)
{
    $stmt = getDB()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function query($sql)
{
    $stmt = getDB()->query($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
