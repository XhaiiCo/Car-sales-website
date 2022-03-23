<?php

require_once "..\util\db.php";


if (!isset($_POST['id']))
    exit;

$id = $_POST['id'];


$stmt = getDB()->prepare("
select * from sale
where sale.id_sale = :id
");

$stmt->execute([
    'id' => $id
]);

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
