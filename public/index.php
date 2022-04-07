<?php
require_once "../src/controller/authController.php";
require '../vendor/autoload.php';

$racine = "/Proj-tm-2022/public";

$router = new AltoRouter();

// ****************************************************************
//                              USER
// ****************************************************************
$router->map('GET', $racine . "/", function () {
    require "../src/view/v_home.php";
}, 'home');

$router->map('GET', $racine . "/annonces", function () {
    require "../src/view/v_ads.php";
}, 'annonces');

$router->map('GET', $racine . "/annonce-[i:id]", function ($id) {
    require "../src/view/v_ad.php";
}, 'annonce');

$router->map('GET', $racine . '/connexion', function () {
    global $router;
    require "../src/view/v_login.php";
}, 'connexion');

$router->map('GET', $racine . '/inscription', function () {
    global $router;
    require "../src/view/v_signup.php";
}, 'inscription');

$router->map('GET', $racine . '/mon-profil', function () {
    global $router;
    if (isConnected()) {
        require "../src/view/v_profil.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'profil');

// ****************************************************************
//                              SELLER
// ****************************************************************
$router->map('GET', $racine . '/mes-annonces', function () {
    global $router;
    if (isSeller()) {
        require "../src/view/seller/v_seller_ads.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'seller_ads');

$router->map('GET', $racine . '/nouvelle-annonce', function () {
    global $router;
    if (isSeller()) {
        require "../src/view/seller/v_seller_new_ad.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'seller_new_ad');


// ****************************************************************
//                              ADMIN
// ****************************************************************
$router->map('GET', $racine . '/admin-utilisateurs', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_user.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_user');

$router->map('GET', $racine . '/admin-annonces', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_ads.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_ads');




$match = $router->match();

if ($match !== false) {
    require_once "../src/elements/header.php";
    call_user_func_array($match['target'], $match['params']); //Passe les argument à la fonction
    require_once "../src/elements/footer.php";
} else {
    global $router;
    require "../src/view/v_404.php";
}
