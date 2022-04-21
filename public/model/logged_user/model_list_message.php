<?php

require_once "../../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

require_once "../../../src/util/db.php";

$user = getEmail();

$sql =
    "
    SELECT 
    case when conversation.user1 like :user then conversation.user2 else user1 end as user,
    conversation.id_sale,
    conversation.id_conversation
    , sale.brand_name, sale.model_name FROM conversation
    inner join sale using(id_sale)
    where user1 like :user or user2 like :user 
";

$datas = prepare($sql, ["user" => $user]);

echo utf8_encode(json_encode($datas));
