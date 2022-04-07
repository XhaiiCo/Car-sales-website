<?php
require_once "../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

if (!isset($_POST)) {
    exit();
}

$currentPassword = $_POST['current_password'];
$password = $_POST['new_password'];
$confirmPassword = $_POST['confirme_new_password'];

// Check if the password is equals
if ($password != $confirmPassword) {
    leave(["error" => 1, "em" => "Mot de passe pas équivalent"]);
}

require_once "../../src/util/user.php";
require_once "../../src/util/db.php";

$sql = "
SELECT user_password from user where (user.user_mail like :mail)
";

$params = [
    "mail" => getEmail()
];

$user = prepare($sql, $params);

if (!password_verify($currentPassword, $user[0]['user_password'])) {
    leave(["error" => 1, "em" => "Mot de passe incorrect"]);
}

if (!validPassword($password)) {
    leave(["error" => 1, "em" => "Mot de passe incorrect (min: " . $MINLENGHT_PASSWORD . " caractères et au moins 1 lettre et 1 chiffre)"]);
}

$sql = "update user set user_password = :password where user_mail like :mail";
$params = [
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "mail" => getEmail()
];

prepare($sql, $params);

leave(["success" => 1, "sm" => "Paramètres modifié avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
