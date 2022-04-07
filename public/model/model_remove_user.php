<?php

require_once "../../src/controller/authController.php";

if (!isAdmin()) {
    exit();
}

$user = $_POST['user'];

require_once "../../src/util/db.php";

if (!isset($_POST))
    exit();

$sql = "
select *
from user where 
    (user.user_mail like :user)
";

$params = [
    "user" => $user
];

$user = prepare($sql, $params);

if ($user[0]['isAdmin'] === "1") {
    exit();
}

$sql = "delete from user where user_mail like :user";

prepare($sql, $params);
