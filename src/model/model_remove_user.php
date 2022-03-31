<?php

$user = "test@test.be";

require_once "..\util\db.php";

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

// if ($rs[0]['isSeller'] === "1") {
//     $sql = "delete from sale where user_mail like :user";

//     $stmt = getDB()->prepare($sql);

//     $stmt->execute([
//         "user" => $user
//     ]);
// }

$sql = "delete from user where user_mail like :user";

$stmt = getDB()->prepare($sql);

$stmt->execute([
    "user" => $user
]);
