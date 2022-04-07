<?php

require_once "../../src/util/db.php";


if (!isset($_POST['id']))
    exit;

$id = $_POST['id'];

$sql = "
select 
    sale.brand_name, 
    sale.model_name,
    sale.price,
    sale.sale_description,
    date_format(sale.publication_date, '%d-%m-%Y') as publication_date,
    sale.car_kilometer,
    sale.car_year,
    sale.car_power,
    sale.car_fuel,
    sale.car_color,
    sale.car_state,
    sale.additional_info,
    user.username
from sale
inner join user using(user_mail)
where sale.id_sale = :id
";

$params = [
    'id' => $id
];

$ad = prepare($sql, $params);

echo utf8_encode(json_encode($ad));
