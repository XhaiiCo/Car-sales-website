<?php

require_once "../../../src/controller/authController.php";

if (!isSeller() && !isAdmin()) {
    exit();
}
$id = $_POST["id"];

require_once "../../../src/util/db.php";

//Before deleting an ad from a seller check that the ad is really his
if (isSeller()) {
    $sql = "select id_sale from sale where id_sale = :id and user_mail = :mail";
    $params = [
        "id" => $id,
        "mail" => getEmail()
    ];

    $exist = prepare($sql, $params);
    if (empty($exist)) {
        exit();
    }
}

if (!isset($_POST))
    exit();

$sql = "delete from sale where id_sale = :id";

prepare($sql, ["id" => $id]);
