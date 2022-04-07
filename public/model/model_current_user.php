<?php

require_once "../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

require_once "../../src/util/db.php";


$sql = "
select 
    user.user_mail,
    user.username,
    date_format(user.date_registration, '%d-%m-%Y') as date_registration
from user where 
    user.user_mail like :q
";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "q" => getEmail()
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
