<?php

if (!isset($_POST)) {
    exit();
}
$MINLENGHT_PASSWORD = 6;

$username = $_POST['username'];
$mail = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['comfirm-password'];

// Check if the password is equals
if ($password != $confirmPassword) {
    echo "Mot de passe pas équivalent";
    exit();
}

if (strlen($password) < $MINLENGHT_PASSWORD) {
    echo "Mot de passe incorrect (min: " . $MINLENGHT_PASSWORD . " caractères)";
    exit();
}


require_once "..\util\db.php";

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
