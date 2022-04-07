<?php

require_once "../../src/controller/authController.php";

if (!isAdmin()) {
    exit();
}

require_once "../../src/util/db.php";

if (!isset($_POST))
    exit();

$q = $_POST['q'];
$role = $_POST['role'];

$sql = "
select 
    user.user_mail,
    user.username,
    user.isAdmin,
    user.isSeller,
    date_format(user.date_registration, '%d-%m-%Y') as date_registration
from user where 
    (user.user_mail like :q ||
    user.username like :q)
";

if ($role === 'admin') {
    $sql .= "and isAdmin = 1";
} else if ($role === 'seller') {
    $sql .= "and isSeller = 1";
} else if ($role === 'user') {
    $sql .= "and (isSeller = 0 and isAdmin = 0)";
}
$users = prepare($sql, ["q" => "%" . $q . "%"]);

echo utf8_encode(json_encode($users));
