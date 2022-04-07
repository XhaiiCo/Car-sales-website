<?php

require_once "../../src/util/db.php";

$brand = "%";
if (isset($_POST['brand_select']))
    $brand = $_POST['brand_select'];

$sql = "
select * from car_model where brand_name like :brand
";

$params = [
    "brand" => $brand
];

$models = prepare($sql, $params);

echo utf8_encode(json_encode($models));
