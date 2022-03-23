<?php

require_once "..\util\db.php";


if (!isset($_POST['id']))
    exit;

$id = $_POST['id'];


$stmt = getDB()->prepare("
select car_picture.picture_name from car_picture
where id_sale = :id
order by car_picture.picture_order
");

$stmt->execute([
    "id" => $id
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
