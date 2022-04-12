<?php
require_once "../../../src/controller/authController.php";

if (!isConnected()) {
    exit();
}

require_once "../../../src/util/db.php";

$sql = "
select *
from user where 
    (user.user_mail like :user)
";

$params = [
    "user" => getEmail()
];

$user = prepare($sql, $params);

$sql = "delete from user where user_mail like :user";

prepare($sql, $params);


logout();
