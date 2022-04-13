<?php
require_once "../../../src/controller/authController.php";

if (!isSeller()) {
    exit();
}

if (!isset($_POST)) {
    leave(["error" => 1, "em" => "Erreur"]);
}

if (!isset($_FILES['car_img_1']) || $_FILES['car_img_1']['name'] === "") {
    leave(["error" => 1, "em" => "Veuillez ajouter au moins une image"]);
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

for ($i = 1; $i <= 7; $i++) {

    if (!isset($_FILES['car_img_' . $i]) || $_FILES['car_img_' . $i]['name'] === "") {
        break;
    }

    $img_name = $_FILES['car_img_' . $i]['name'];
    $img_size = $_FILES['car_img_' . $i]['size'];
    $tmp_name = $_FILES['car_img_' . $i]['tmp_name'];
    $error = $_FILES['car_img_' . $i]['error'];


    if ($error !== 0) {
        leave(["error" => 1, "em" => "Erreur inconue pour l'image n°" . $i]);
    }

    // Check image size
    if ($img_size > 10000000) {
        leave(["error" => 1, "em" => "Désolé, votre image n°" . $i . " est trop grande"]);
    }

    // Check the extension
    $allowed_exs = array("jpg", "jpeg", "png");
    $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    if (!in_array($img_ex, $allowed_exs)) {
        leave(["error" => 1, "em" => "Ce format de fichier n'est pas accepté pour l'image n°" . $i]);
    }
}


// Added the car in the db
require_once "../../../src/util/db.php";

$sql = "
insert ignore into sale 
(price, publication_date, sale_description, car_kilometer, car_year, car_power,
car_fuel, car_color, car_state,additional_info, model_name, brand_name, user_mail)
values
(:price, date(now()), :sale_description, :car_kilometer, :car_year, :car_power, :car_fuel, :car_color, :car_state ,:additional_info, :model_name, :brand_name, :user)
";

$db = getDB();

$db->beginTransaction();
$stmt = $db->prepare($sql);

$stmt->execute($car);

$lastInsert = $db->lastInsertId();

for ($i = 1; $i <= 7; $i++) {

    if (!isset($_FILES['car_img_' . $i]) || $_FILES['car_img_' . $i]['name'] === "") {
        break;
    }

    $img_name = $_FILES['car_img_' . $i]['name'];
    $img_size = $_FILES['car_img_' . $i]['size'];
    $tmp_name = $_FILES['car_img_' . $i]['tmp_name'];
    $error = $_FILES['car_img_' . $i]['error'];

    $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    //Move the img
    $new_img_name = uniqid("IMG-", true) . "." . $img_ex;
    $img_upload_path = "../../../public/assets/img/car_on_sale/" . $new_img_name;

    move_uploaded_file($tmp_name, $img_upload_path);
    $sql = "insert ignore into car_picture
    (picture_name, picture_order, id_sale)
    values
    (:img_name, :order, :id)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        "img_name" => $new_img_name,
        "id" => $lastInsert,
        "order" => $i
    ]);
}

$db->commit();

leave(["success" => 1, "sm" => "Voiture ajouté avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
