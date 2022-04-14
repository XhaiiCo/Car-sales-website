<?php
require_once "../src/controller/authController.php";
require '../vendor/autoload.php';

$router = new AltoRouter();

// The path to the public flocer (root)
$basePath = "/Proj-tm-2022/public";

$router->setBasePath($basePath);


// ****************************************************************
//                              USER
// ****************************************************************
$router->map('GET', "/", function () {
    global $router;
    require "../src/view/v_home.php";
}, 'home');

$router->map('GET', "/annonces", function () {
    require "../src/view/v_ads.php";
}, 'annonces');

$router->map('GET', "/annonce-[i:id]", function ($id) {
    require "../src/view/v_ad.php";
}, 'annonce');

$router->map('GET', '/connexion', function () {
    global $router;
    require "../src/view/v_login.php";
}, 'connexion');

$router->map('GET', '/inscription', function () {
    global $router;
    require "../src/view/v_signup.php";
}, 'inscription');


// ****************************************************************
//                             LOGGED USER
// ****************************************************************
$router->map('GET', '/mon-profil', function () {
    global $router;
    if (isConnected()) {
        require "../src/view/logged_user/v_profil.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'profil');

// ****************************************************************
//                              SELLER
// ****************************************************************
$router->map('GET', '/mes-annonces', function () {
    global $router;
    if (isSeller()) {
        require "../src/view/seller/v_seller_ads.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'seller_ads');

$router->map('GET', '/nouvelle-annonce', function () {
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
$router->map('GET', '/admin-utilisateurs', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_user.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_user');

$router->map('GET', '/admin-annonces', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_ads.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_ads');

$router->map('GET', '/admin-vehicules', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_cars.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_cars');

$router->map('GET', '/admin-candidature', function () {
    global $router;
    if (isAdmin()) {
        require "../src/view/admin/v_admin_candidacy.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'admin_candidacy');



$match = $router->match();

if ($match !== false) {
    require_once "../src/elements/header.php";
    call_user_func_array($match['target'], $match['params']); //Passe les argument à la fonction
    require_once "../src/elements/footer.php";
} else {
    global $router;
    require "../src/view/v_404.php";
}
