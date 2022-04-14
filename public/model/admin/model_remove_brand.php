<?php

require_once "../../../src/controller/authController.php";

if (!isAdmin() || !isset($_POST)) {
    exit();
}

require_once "../../../src/util/db.php";

$brand = $_POST['brand'];

$sql = "SELECT brand_name from sale where brand_name like :brand";

$exist = prepare($sql, ["brand" => $brand]);

if (!empty($exist)) {
    leave(["error" => 1, "em" => "Impossible de supprimer cette marque car des annonces y sont associé"]);
}

$sql = "delete from car_brand where brand_name like :brand";

prepare($sql, ["brand" => $brand]);

leave(["success" => 1, "sm" => "Marque supprimé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
