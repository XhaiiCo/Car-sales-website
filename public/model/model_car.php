<?php

if (!isset($_POST))
    exit();

$q = $_POST['q'];
$brand = $_POST['brand'];
require_once "../../src/util/db.php";

$sql = "select * from car_model where model_name like :q and brand_name like :brand";

$brands = prepare($sql, ["q" => "%" . $q . "%", "brand" => $brand]);

echo utf8_encode(json_encode($brands));
