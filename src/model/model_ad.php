<?php

require_once "..\util\db.php";

$stmt = getDB()->query("
select sale.*, car_picture.picture_name from sale
inner join car_picture using(id_sale) where car_picture.picture_order = 1 ;
");
$stmt->execute();

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
