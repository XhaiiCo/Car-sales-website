<?php

require_once "../../src/util/db.php";

if (!isset($_POST['id']))
    exit;

$id = $_POST['id'];

$sql = "
select car_picture.picture_name from car_picture
where id_sale = :id
order by car_picture.picture_order
";

$params = [
    "id" => $id
];

$car_pictures = prepare($sql, $params);

echo utf8_encode(json_encode($car_pictures));
