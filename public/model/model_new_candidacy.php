<?php
//todo Regarder si il a pas déjà fait une candidature

leave(["success" => 1, "sm" => "Candidature envoyé avec succès"]);

function leave($response)
{
    echo utf8_encode(json_encode($response));
    exit();
}
