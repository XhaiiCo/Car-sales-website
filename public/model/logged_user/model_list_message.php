<?php

require_once "../../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

require_once "../../../src/util/db.php";

$user = getEmail();

$sql =
    "
    SELECT * FROM message_sale 
    where user_from like :user or user_to like :user
";
$datas = prepare($sql, ["user" => $user]);
for ($i = 0; $i < count($datas); $i++) {
    $user_from = $datas[$i]['user_from'];
    $user_to = $datas[$i]['user_to'];
    $id = $datas[$i]['id_sale'];
    for ($j = $i + 1; $j < count($datas); $j++) {
        if ($datas[$j]['id_sale'] === $id) {
            if ($datas[$j]['user_to'] === $user_from || $datas[$j]['user_to'] === $user_from) {
                if ($datas[$j]['user_from'] === $user_to || $datas[$j]['user_from'] === $user_to) {
                    unset($datas[$j]);
                }
            }
        }
    }
}

var_dump($datas);


//echo utf8_encode(json_encode($datas));
