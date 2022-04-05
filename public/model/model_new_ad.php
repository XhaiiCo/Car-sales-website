<?php
require_once "../../src/controller/authController.php";

if (!isSeller()) {
    exit();
}

if (!isset($_POST)) {
    leave(["error" => 1, "em" => "Erreur"]);
}

$car = array(
    "price" => floatval(str_replace(",", ".", $_POST["price"])),
    "additional_info" => $_POST["additional_info"],
    "sale_description" => $_POST["sale_description"],
    "brand_name" => $_POST["brand_select"],
    "model_name" => $_POST["model_select"],
    "car_power" => intval($_POST["car_power"]),
    "car_fuel" => $_POST["car_fuel"],
    "car_state" => $_POST["car_state"],
    "car_color" => $_POST["car_color"],
    "car_year" => intval($_POST["car_year"]),
    "car_kilometer" => intval($_POST["car_kilometer"]),
    "user" => getEmail()
);

//Price check
if (!is_float($car['price']) ||  $car['price'] === 0.) {
    leave(["error" => 1, "em" => "Prix incorrect"]);
}

//Brand name check
if ($car["brand_name"] === "%") {
    leave(["error" => 1, "em" => "Veuillez choisir une marque de voiture"]);
}

//Car power check
if (!is_int($car['car_power']) ||  $car['car_power'] === 0) {
    leave(["error" => 1, "em" => "Puissance incorrect"]);
}

//Car year check
if (!is_int($car['car_year']) ||  $car['car_year'] === 0) {
    leave(["error" => 1, "em" => "Année incorrect"]);
}

//Car kilometer check
if (!is_int($car['car_kilometer']) ||  $car['car_kilometer'] === 0) {
    leave(["error" => 1, "em" => "kilométrage incorrect"]);
}

// Added the car in the db

require_once "../../src/util/db.php";


$car = array(
    "price" => floatval(str_replace(",", ".", $_POST["price"])),
    "additional_info" => $_POST["additional_info"],
    "sale_description" => $_POST["sale_description"],
    "brand_name" => $_POST["brand_select"],
    "model_name" => $_POST["model_select"],
    "car_power" => intval($_POST["car_power"]),
    "car_fuel" => $_POST["car_fuel"],
    "car_state" => $_POST["car_state"],
    "car_color" => $_POST["car_color"],
    "car_year" => $_POST["car_year"],
    "car_kilometer" => intval($_POST["car_kilometer"]),
    "user" => getEmail()
);
$sql = "
insert ignore into sale 
(price, publication_date, sale_description, car_kilometer, car_year, car_power,
car_fuel, car_color, car_state,additional_info, model_name, brand_name, user_mail)
values
(:price, date(now()), :sale_description, :car_kilometer, :car_year, :car_power, :car_fuel, :car_color, :car_state ,:additional_info, :model_name, :brand_name, :user)
";

$db = getDB();
$stmt = $db->prepare($sql);

$stmt->execute($car);

$lastInsert = $db->lastInsertId();

leave(["success" => 1, "sm" => "Voiture ajouté avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
