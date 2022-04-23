<?php

require_once "../../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

require_once "../../../src/util/db.php";

$id_conversation = $_POST['id_conversation'];
$user = getEmail();

$sql = "SELECT id_conversation from conversation where user1 like :user || user2 like :user";

$exits = prepare($sql, ["user" => $user]);

if (empty($exits)) {
    exit();
}

$sql  = "
SELECT message.*, user.username
from message 
inner join user on user_send like user_mail
where id_conversation = :id order by date_send desc
";

$datas = prepare($sql, ["id" => $id_conversation]);

echo utf8_encode(json_encode($datas));
