<?php

$MINLENGHT_USERNAME = 3;
$MINLENGHT_PASSWORD = 6;
$MAXLENGHT_USERNAME = 100;

function validUsername($username)
{
    global $MINLENGHT_USERNAME;
    global $MAXLENGHT_USERNAME;

    if (strlen($username) < $MINLENGHT_USERNAME || strlen($username) > $MAXLENGHT_USERNAME || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        return false;
    }
    return true;
}

function validPassword($password)
{
    global $MINLENGHT_PASSWORD;
    if (strlen($password) < $MINLENGHT_PASSWORD || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{" . $MINLENGHT_PASSWORD . ",}$/", $password)) {
        return false;
    }
    return true;
}

function validMail($mail)
{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
        return false;
    }

    return true;
}
