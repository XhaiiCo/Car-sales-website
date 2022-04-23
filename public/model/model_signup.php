<?php

if (!isset($_POST)) {
    exit();
}
$MINLENGHT_USERNAME = 3;
$MINLENGHT_PASSWORD = 6;

$username = $_POST['username'];
$mail = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];

require_once "../../src/util/user.php";


if (!validUsername($username)) {
    leave(["error" => 1, "em" => "Nom d'utilisateur incorrect (min: " . $MINLENGHT_USERNAME . " caractères, sans espace, et sans caractères spéciaux)"]);
}

// Check if the password is equals
if ($password != $confirmPassword) {
    leave(["error" => 1, "em" => "Mot de passe pas équivalent"]);
}

if (!validPassword($password)) {
    leave(["error" => 1, "em" => "Mot de passe incorrect (min: " . $MINLENGHT_PASSWORD . " caractères et au moins 1 lettre et 1 chiffre)"]);
}

require_once "../../src/util/db.php";

//Check if the username not already exists
$sql = "SELECT * FROM user where username like :username";

$user = prepare($sql, ["username" => $username]);

if (!empty($user)) {
    leave(["error" => 1, "em" => "Ce nom d'utilisateur est déjà utilisé"]);
}

//Check if the mail not already exists and correct
$sql = "SELECT * FROM user where user_mail like :mail";

$user = prepare($sql, ["mail" => $mail]);

if (!empty($user) || !validMail($mail)) {
    leave(["error" => 1, "em" => "Email incorrect ou déjà utilisé"]);
}

$sql = "
insert ignore into user 
(user_mail, username, user_password, isAdmin, isSeller, date_registration)
values
(:mail, :username, :password, 0, 0, now())";

$params = [
    "mail" => $mail,
    "username" => $username,
    "password" => password_hash($password, PASSWORD_DEFAULT)
];

prepare($sql, $params);

require_once "../../src/controller/authController.php";

login($username, $mail, 0, 0);

leave(["success" => 1, "sm" => "Votre compte a été créé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
