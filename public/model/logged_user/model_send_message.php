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
    select id_conversation 
    from conversation
    where 
        (id_sale = :id)
        &&
        (
            (user1 like :user1 || user2 like :user1) ||
            (user1 like :user2 || user2 like :user2)
        )
";

$params = [
    "id" => $id,
    "user1" => $user_to,
    "user2" => $user_from
];

$conversation = prepare($sql, $params);

if (empty($conversation)) {
    $sql = "
        INSERT INTO `conversation` 
            (`user1`, `user2`, `id_sale`) 
        VALUES 
            (:user1, :user2, :id)
    ";

    prepare($sql, $params);
    $idConversation = getDB()->lastInsertId();
} else {
    $idConversation = $conversation[0]['id_conversation'];
}

$sql = "
    INSERT IGNORE INTO message
    VALUES 
    (NULL, :user_from, :message, now(), :id_conversation) ;
";

$params = [
    "message" => $message,
    "user_from" => $user_from,
    "id_conversation" => $idConversation
];

prepare($sql, $params);
leave(["success" => 1, "sm" => "Message envoyé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
