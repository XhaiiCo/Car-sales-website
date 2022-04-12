<?php
require_once "../../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

if (!isset($_POST)) {
    exit();
}

$username = $_POST['username'];
$mail = $_POST['mail'];
$MINLENGHT_USERNAME = 3;

require_once "../../../src/util/user.php";
require_once "../../../src/util/db.php";


//Check if the username not already exists
$sql = "SELECT * FROM user where username like :username";

$user = prepare($sql, ["username" => $username]);

if ($username != getUsername() && !empty($user)) {
    leave(["error" => 1, "em" => "Ce nom d'utilisateur est déjà utilisé"]);
}

if (!validUsername($username)) {
    leave(["error" => 1, "em" => "Nom d'utilisateur incorrect (min: " . $MINLENGHT_USERNAME . " caractères, sans espace, et sans caractères spéciaux)"]);
}

$sql = "SELECT * FROM user where user_mail like :mail";

$user = prepare($sql, ["mail" => $mail]);

if ($mail != getEmail() && !empty($user) || !validMail($mail)) {
    leave(["error" => 1, "em" => "Email incorrect ou déjà utilisé"]);
}

$sql = "
    update user set 
    username = :username, user_mail = :mail
    where user_mail = :user
";

$params = [
    "user" => getEmail(),
    "username" => $username,
    "mail" => $mail
];

prepare($sql, $params);
update($username, $mail);

leave(["success" => 1, "sm" => "Paramètres modifié avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
