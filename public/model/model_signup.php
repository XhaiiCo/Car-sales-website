<?php

if (!isset($_POST)) {
    exit();
}
$MINLENGHT_PASSWORD = 6;
$MINLENGHT_USERNAME = 3;

$username = $_POST['username'];
$mail = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];


if (strlen($username) < $MINLENGHT_USERNAME || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    echo "Nom d'utilisateur incorrect (min: " . $MINLENGHT_USERNAME . " caractères, sans espace, et sans caractères spéciaux)";
    exit();
}

// Check if the password is equals
if ($password != $confirmPassword) {
    echo "Mot de passe pas équivalent";
    exit();
}

if (strlen($password) < $MINLENGHT_PASSWORD || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{" . $MINLENGHT_PASSWORD . ",}$/", $password)) {
    echo "Mot de passe incorrect (min: " . $MINLENGHT_PASSWORD . " caractères et au moins 1 lettre et 1 chiffre)";
    exit();
}

require_once "../../src/util/db.php";

//Check if the username not already exists
$stmt = getDB()->prepare("SELECT * FROM user where username like :username");

$stmt->execute([
    "username" => $username
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($rs)) {
    echo "Ce nom d'utilisateur est déjà utilisé";
    exit();
}

//Check if the mail not already exists and correct
$stmt = getDB()->prepare("SELECT * FROM user where user_mail like :mail");

$stmt->execute([
    "mail" => $mail
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($rs) || filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
    echo "Email incorrect ou déjà utilisé";
    exit();
}

$sql = "
insert ignore into user 
(user_mail, username, user_password, isAdmin, isSeller, date_registration)
values
(:mail, :username, :password, 0, 0, now())";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "mail" => $mail,
    "username" => $username,
    "password" => password_hash($password, PASSWORD_DEFAULT)
]);

echo "ok";
