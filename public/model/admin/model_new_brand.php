<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin() || !isset($_POST)) {
    exit();
}

$brand = $_POST['brand'];

require_once "../../../src/util/db.php";


$sql = "select brand_name from car_brand where brand_name like :brand";

$exist = prepare($sql, ["brand" => $brand]);

if (!empty($exist)) {
    leave(["error" => 1, "em" => "Marque déjà présente"]);
}


$sql = "insert ignore into car_brand value (:brand)";

prepare($sql, ["brand" => $brand]);

leave(["success" => 1, "sm" => "Marque ajouté avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
