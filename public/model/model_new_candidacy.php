<?php

require_once "../../src/controller/authController.php";

if (!isConnected() || isSeller() || !isset($_POST)) {
    leave(["error" => 1, "em" => "Error"]);
}

require_once "../../src/util/db.php";

$user = getEmail();

$sql = "select id_candidacy from seller_candidacy where user_from like :user";

$exist = prepare($sql, ["user" => $user]);

if (!empty($exist)) {
    leave(["error" => 1, "em" => "Votre candidature n'a pas été envoyé car vous en avez déjà envoyé une"]);
}

$candidacy = $_POST["candidacy"];

$sql = "insert ignore into seller_candidacy (user_message, user_from) values (:user_message, :user)";

$params =  [
    "user_message" => $candidacy,
    "user" => $user
];

prepare($sql, $params);

leave(["success" => 1, "sm" => "Candidature envoyé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
