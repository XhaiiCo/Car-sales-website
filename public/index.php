<?php
require_once "../src/controller/authController.php";
require '../vendor/autoload.php';

$racine = "/proj-tm-2022/public";

$router = new AltoRouter();

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
    require "../src/view/v_signup.php";
}, 'inscription');

$router->map('GET', $racine . '/nouvelle-annonce', function () {
    global $router;
    if (isSeller()) {
        require "../src/view/v_seller_new_ad.php";
    } else {
        header("Location: " . $router->generate('home'));
    }
}, 'new-ad');

$match = $router->match();

require_once "../src/elements/header.php";
if ($match !== false) {
    call_user_func_array($match['target'], $match['params']); //Passe les argument à la fonction
} else {
    echo "404";
}

require_once "../src/elements/footer.php";
