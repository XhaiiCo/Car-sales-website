<?php require_once "../src/controller/authController.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .dropdown-item {
            cursor: pointer;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../src/util/import.php" ?>
    <title>DLMotors</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= $router->generate('home') ?>">DLMotors</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->generate('home') ?>">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->generate('annonces') ?>">Annonces</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isSeller()) : ?>
                            <li class="nav-item mx-lg-2 my-2 my-lg-0">
                                <a class="btn btn-info" href="<?= $router->generate('seller_ads') ?>">Mes annonces</a>
                            </li>
                        <?php endif; ?>
                        <?php if (isAdmin()) : ?>
                            <li class="nav-item mx-lg-2 my-2 my-lg-0">
                                <a class="btn btn-info" href="<?= $router->generate('admin_user') ?>">Gestion</a>
                            </li>
                        <?php endif; ?>
                        <?php if (isConnected()) : ?>
                            <li class="dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-person-circle h6"></i>
                                        <?= getUsername() ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Profil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li id="logout" class="dropdown-item">Se déconnecter</li>
                                    </ul>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav-item mx-3">
                                <a class="btn btn-dark nav-link" href="<?= $router->generate('inscription') ?>">
                                    Inscription
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-secondary nav-link" href="<?= $router->generate('connexion') ?>">
                                    <i class="bi bi-person"></i>Connexion
                                </a>
                            </li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <script>
        $("#logout").click(function() {
            $.ajax({
                url: "./model/model_logout.php",
                success: function() {
                    window.location.reload();
                }
            });
        });
    </script>