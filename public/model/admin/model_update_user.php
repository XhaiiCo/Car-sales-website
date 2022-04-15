<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin()) {
    exit();
}

$user = $_POST['user'];

require_once "../../../src/util/db.php";

if (!isset($_POST))
    exit();

$user = $_POST['user'];
$isAdmin = ($_POST['isAdmin'] === 'true' ? 1 : 0);
$isSeller = ($_POST['isSeller'] === 'true' ? 1 : 0);

if ($isSeller === 0) {

    $sql = "
        select picture_name from car_picture 
        inner join sale using(id_sale)
        where user_mail like :mail
    ";

    $car_pictures = prepare($sql, ["mail" => $user]);

    $basePath = "./../../assets/img/car_on_sale/";
    foreach ($car_pictures as $car_picture) {
        unlink($basePath . $car_picture["picture_name"]);
    }

    $sql = "delete from sale where user_mail like :mail ";

    prepare($sql, ["mail" => $user]);
}

$sql = "
    update user set 
    isAdmin = :isAdmin, isSeller = :isSeller 
    where user_mail = :user
";

$params = [
    "user" => $user,
    "isAdmin" => $isAdmin,
    "isSeller" => $isSeller
];

prepare($sql, $params);
