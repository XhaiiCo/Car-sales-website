<?php

require_once "../util/db.php";

$stmt = getDB()->query("select brand_name from car_brand");
$stmt->execute();

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
