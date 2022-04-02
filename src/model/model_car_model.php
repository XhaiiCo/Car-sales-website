<?php

require_once "../util/db.php";

$brand = "%";
if (isset($_POST['brand_select']))
    $brand = $_POST['brand_select'];

$stmt = getDB()->prepare("
select * from car_model where brand_name like :brand
");
$stmt->execute([
    "brand" => $brand
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
