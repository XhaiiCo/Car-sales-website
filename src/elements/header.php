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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
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
                        <?php if (isSeller()) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./seller_new_ad.php">Créer une annonce</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isConnected()) : ?>
                            <li class="dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $router->generate('connexion') ?>">Se connecter</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container">


        <script>
            $("#logout").click(function() {
                $.ajax({
                    url: "../src/model/model_logout.php",
                    success: function() {
                        window.location.reload();
                    }
                });
            });
        </script>