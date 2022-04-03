<?php

$user = $_POST['user'];

require_once "../../src/util/db.php";

if (!isset($_POST))
    exit();


$sql = "
select *
from user where 
    (user.user_mail like :user)
";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "user" => $user
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($rs);

if ($rs[0]['isAdmin'] === "1") {
    exit();
}

$sql = "delete from user where user_mail like :user";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "user" => $user
]);
