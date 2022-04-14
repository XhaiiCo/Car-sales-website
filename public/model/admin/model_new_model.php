<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin() || !isset($_POST)) {
    exit();
}

$brand = $_POST['brand'];
$model = $_POST['model'];

require_once "../../../src/util/db.php";


$sql = "select brand_name from car_model where brand_name like :brand and model_name like :model";

$exist = prepare($sql, ["brand" => $brand, "model" => $model]);

if (!empty($exist)) {
    leave(["error" => 1, "em" => "Modèle déjà présente"]);
}

$sql = "insert ignore into car_model value (:model, :brand)";

prepare($sql, ["brand" => $brand, "model" => $model]);

leave(["success" => 1, "sm" => "Modèle ajouté avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
