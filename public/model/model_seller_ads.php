<?php
require_once "../../src/controller/authController.php";

if (!isSeller() || !isset($_POST)) {
	exit();
}

require_once "../../src/util/db.php";

$q = $_POST['q'];
$seller = $_POST['seller'];

$sql = "
select *
from sale
where 
user_mail like :seller
and (brand_name like :q or model_name like :q or car_year like :q or publication_date like :q)
";

$params = [
	"seller" => $seller,
	"q" => "%" . $q . "%"
];

$ads = prepare($sql, $params);

echo utf8_encode(json_encode($ads));
