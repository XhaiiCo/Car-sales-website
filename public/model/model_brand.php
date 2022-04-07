<?php

require_once "../../src/util/db.php";

$brands = query("select brand_name from car_brand");

echo utf8_encode(json_encode($brands));
