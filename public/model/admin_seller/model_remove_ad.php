<?php

require_once "../../../src/controller/authController.php";

if (!isSeller() && !isAdmin()) {
    exit();
}

require_once "../../../src/util/db.php";

if (!isset($_POST))
    exit();

$sql = "delete from sale where id_sale = :id";

prepare($sql, ["id" => $_POST["id"]]);
