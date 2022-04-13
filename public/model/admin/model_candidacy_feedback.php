<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin() || !isset($_POST)) {
    exit();
}

require_once "../../../src/util/db.php";

$user = $_POST['user'];
$isSeller = ($_POST['isSeller'] === '1' ? 1 : 0);

$sql = "
    update user set 
    isSeller = :isSeller 
    where user_mail = :user
";

$params = [
    "user" => $user,
    "isSeller" => $isSeller
];

prepare($sql, $params);

$sql = "delete from seller_candidacy where user_from like :user";

$params = [
    "user" => $user,
];

prepare($sql, $params);
