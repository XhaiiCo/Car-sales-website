<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin()) {
    exit();
}

$userMail = $_POST['user'];

require_once "../../../src/util/db.php";

if (!isset($_POST))
    exit();

$sql = "
select *
from user where 
    (user.user_mail like :user)
";

$params = [
    "user" => $userMail
];

$user = prepare($sql, $params);

if ($user[0]['isAdmin'] === "1") {
    exit();
}

if ($user[0]['isSeller'] === "1") {
    $sql = "
        select picture_name from car_picture 
        inner join sale using(id_sale)
        where user_mail like :mail
    ";

    $car_pictures = prepare($sql, ["mail" => $userMail]);

    $basePath = "./../../assets/img/car_on_sale/";
    foreach ($car_pictures as $car_picture) {
        unlink($basePath . $car_picture["picture_name"]);
    }
}

$sql = "delete from user where user_mail like :user";

prepare($sql, $params);
