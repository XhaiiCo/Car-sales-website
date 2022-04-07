<?php

if (!isset($_POST['mail']) && !isset($_POST['password'])) {
    echo 0;
    exit();
}

require_once "../../src/util/db.php";

$mail = $_POST['mail'];
$password = $_POST['password'];

$sql = "
SELECT * from user where (user.user_mail like :mail or user.username like :mail)
";

$params = [
    "mail" => $mail
];

$user = prepare($sql, $params);

if (empty($user)) {
    echo 0;
    exit();
}

if (password_verify($password, $user[0]['user_password'])) {
    require_once "../../src/controller/authController.php";
    login($user[0]['username'], $user[0]['user_mail'], $user[0]['isAdmin'], $user[0]['isSeller']);
    echo 1;
    exit();
}

echo 0;
