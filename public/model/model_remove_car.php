<?php

require_once "../../src/controller/authController.php";

if (!isSeller() && !isAdmin()) {
    exit();
}

require_once "../../src/util/db.php";

if (!isset($_POST))
    exit();

$model = $_POST['model'];
$brand = $_POST['brand'];

$sql = "SELECT brand_name from sale where brand_name like :brand and model_name like :model";

$exist = prepare($sql, ["brand" => $brand, "model" => $model]);

if (!empty($exist)) {
    leave(["error" => 1, "em" => "Impossible de supprimer ce model car des annonces y sont associé"]);
}

$sql = "delete from car_model where brand_name like :brand and model_name like :model";

prepare($sql, ["brand" => $brand, "model" => $model]);

leave(["success" => 1, "sm" => "Voiture supprimé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
