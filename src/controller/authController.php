<?php

function login($username, $email, $isAdmin, $isSeller)
{
    startSession();
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['mail'] = $email;
    $_SESSION['user']['isAdmin'] = $isAdmin;
    $_SESSION['user']['isSeller'] = $isSeller;
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
    if (isset($_SESSION['user']['username'])) {
        return true;
    }

    return false;
}

function isAdmin()
{
    startSession();
    if (isset($_SESSION['user']['isAdmin']) && $_SESSION['user']['isAdmin'] === "1") {
        return true;
    }

    return false;
}

function isSeller()
{
    startSession();
    if (isset($_SESSION['user']['isSeller']) && $_SESSION['user']['isSeller'] === "1") {
        return true;
    }

    return false;
}

function getUsername()
{
    startSession();
    if (isset($_SESSION['user']['username'])) {
        return $_SESSION['user']['username'];
    }

    return null;
}

function getEmail()
{
    startSession();
    if (isset($_SESSION['user']['mail'])) {
        return $_SESSION['user']['mail'];
    }

    return null;
}
