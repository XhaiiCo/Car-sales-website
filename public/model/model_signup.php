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
    echo "Nom d'utilisateur incorrect (min: " . $MINLENGHT_USERNAME . " caractères, sans espace, et sans caractères spéciaux)";
    exit();
}

// Check if the password is equals
if ($password != $confirmPassword) {
    echo "Mot de passe pas équivalent";
    exit();
}

if (!validPassword($password)) {
    echo "Mot de passe incorrect (min: " . $MINLENGHT_PASSWORD . " caractères et au moins 1 lettre et 1 chiffre)";
    exit();
}

require_once "../../src/util/db.php";

//Check if the username not already exists
$sql = "SELECT * FROM user where username like :username";

$user = prepare($sql, ["username" => $username]);

if (!empty($user)) {
    echo "Ce nom d'utilisateur est déjà utilisé";
    exit();
}

//Check if the mail not already exists and correct
$sql = "SELECT * FROM user where user_mail like :mail";

$user = prepare($sql, ["mail" => $mail]);

if (!empty($user) || !validMail($mail)) {
    echo "Email incorrect ou déjà utilisé";
    exit();
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

echo "ok";
