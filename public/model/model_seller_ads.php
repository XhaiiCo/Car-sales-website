<?php

require_once "../../src/util/db.php";
require_once "../../src/controller/authController.php";

if (!isSeller() || !isset($_POST)) {
	exit();
}

$q = $_POST['q'];
$seller = $_POST['seller'];

$stmt = getDB()->prepare("
select *
from sale
where 
user_mail like :seller
and (brand_name like :q or model_name like :q or car_year like :q or publication_date like :q)
");

$stmt->execute([
	"seller" => $seller,
	"q" => "%" . $q . "%"
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
