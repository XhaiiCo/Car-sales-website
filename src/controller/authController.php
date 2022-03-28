<?php

function login($username, $isAdmin, $isSeller)
{
    startSession();
    $_SESSION['username'] = $username;
    $_SESSION['isAdmin'] = $isAdmin;
    $_SESSION['isSeller'] = $isSeller;
}

function logout()
{
    startSession();
    session_destroy();
}

function startSession()
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function isConnected()
{
    startSession();
    if (isset($_SESSION['username'])) {
        return true;
    }

    return false;
}

function isAdmin()
{
    startSession();
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === "1") {
        return true;
    }

    return false;
}

function isSeller()
{
    startSession();
    if (isset($_SESSION['isSeller']) && $_SESSION['isSeller'] === "1") {
        return true;
    }

    return false;
}

function getUsername()
{
    startSession();
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }

    return null;
}
