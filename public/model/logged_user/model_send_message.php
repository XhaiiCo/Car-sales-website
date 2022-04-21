<?php

require_once "../../../src/controller/authController.php";

if (!isConnected() || !isset($_POST)) {
    exit();
}

$id = $_POST['id'];
$message = $_POST['message'];

require_once "../../../src/util/db.php";

$sql = "SELECT user_mail from sale where id_sale = :id";

$user_to = prepare($sql, ["id" => $id])[0]['user_mail'];
$user_from = getEmail();

if (empty($user_to)) {
    leave(["error" => 1, "em" => "Erreur: pas de vendeur trouvé"]);
}

$sql = "
    INSERT IGNORE INTO message_sale VALUES (NULL, :message, :user_from, :user_to, :id_sale, now())
";
$params = [
    "message" => $message,
    "user_from" => $user_from,
    "user_to" => $user_to,
    "id_sale" => $id
];

prepare($sql, $params);
leave(["success" => 1, "sm" => "Message envoyé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
