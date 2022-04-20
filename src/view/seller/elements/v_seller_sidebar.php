<?php
if (!isSeller()) {
    exit();
}
?>

<style>
    @media screen and (max-width: 1400px) {

        #content {
            margin-left: 18%;
        }
    }

    @media screen and (max-width: 1200px) {

        #content {
            margin-left: 15%;
        }
    }

    @media screen and (max-width: 992px) {

        #content {
            margin-left: 25%;
        }
    }

    @media screen and (max-width: 768px) {

        #content {
            margin-left: 25%;
        }
    }


    @media screen and (max-width: 576px) {

        #content {
            margin-left: 10%;
        }
    }
</style>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 col-lg-2 px-sm-2 px-0 bg-dark position-fixed">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white vh-100">
                <span class="fs-5 d-none d-sm-inline">Gestion</span>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="<?= $router->generate('seller_new_ad') ?>" class="text-white nav-link px-0 align-middle">
                            <i class="fs-4 bi-cart-plus"></i> <span class="ms-1 d-none d-sm-inline">Nouvelle annonce</span> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $router->generate('seller_ads') ?>" class="text-white nav-link px-0 align-middle">
                            <i class="fs-4 bi-cart"></i> <span class="ms-1 d-none d-sm-inline">Mes annonces</span> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $router->generate('seller_ads') ?>" class="text-white nav-link px-0 align-middle">
                            <i class="fs-4 bi-chat-left"></i> <span class="ms-1 d-none d-sm-inline">Message</span> </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="content" class="col py-3">