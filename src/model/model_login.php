<?php

if (!isset($_POST['mail']) && !isset($_POST['password'])) {
    echo 0;
    exit();
}

require_once "../util/db.php";

$mail = $_POST['mail'];
$password = $_POST['password'];

$stmt = getDB()->prepare("
SELECT * from user where user.user_mail = :mail
");

$stmt->execute([
    "mail" => $mail
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rs)) {
    echo 0;
    exit();
}

if (password_verify($password, $rs[0]['user_password'])) {
    require_once '../controller/authController.php';
    login($rs[0]['username'], $rs[0]['isAdmin'], $rs[0]['isSeller']);
    echo 1;
    exit();
}

echo 0;
