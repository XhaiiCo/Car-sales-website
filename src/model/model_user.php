<?php

require_once "..\util\db.php";

$stmt = getDB()->prepare("
select 
user.user_mail,
user.username,
user.isAdmin,
user.isSeller,
date_format(user.date_registration, '%d-%m-%Y') as date_registration
from user
");

$stmt->execute();

$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo utf8_encode(json_encode($rs));
