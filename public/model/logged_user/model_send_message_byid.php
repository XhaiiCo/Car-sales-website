<?php

require_once "../../../src/controller/authController.php";

if (!isConnected() || !isset($_POST)) {
    exit();
}

$idConversation = $_POST['id'];
$message = $_POST['message'];

require_once "../../../src/util/db.php";

$user_from = getEmail();

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
