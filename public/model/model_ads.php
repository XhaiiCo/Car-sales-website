<?php

require_once "../../src/util/db.php";

$brand = "%";
if (isset($_POST['brand_select']))
	$brand = $_POST['brand_select'];

$model = "%";
if (isset($_POST['model_select']))
	$model = $_POST['model_select'];

$stmt = getDB()->prepare("
select sale.*, 
group_concat(case 
	when car_picture.picture_order = 1 
		then car_picture.picture_name
	else 
		null 
end) as picture_name
from sale
left join car_picture using(id_sale)
where brand_name like :brand and model_name like :model
group by id_sale
");
$stmt->execute([
	"brand" => $brand,
	"model" => $model
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
