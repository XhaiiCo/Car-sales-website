<?php

require_once "../../src/controller/authController.php";

if (!isAdmin()) {
    exit();
}

$user = $_POST['user'];

require_once "../../src/util/db.php";

if (!isset($_POST))
    exit();

$user = $_POST['user'];
$isAdmin = ($_POST['isAdmin'] === 'true' ? 1 : 0);
$isSeller = ($_POST['isSeller'] === 'true' ? 1 : 0);

$sql = "update user set 
    isAdmin = :isAdmin, isSeller = :isSeller 
    where user_mail = :user";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "user" => $user,
    "isAdmin" => $isAdmin,
    "isSeller" => $isSeller
]);
