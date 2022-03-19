<?php

require_once "..\util\db.php" ;

$rq = getDB()->query("Select * from sale") ;
$rq->execute();
var_dump($rq->fetchAll()) ;
