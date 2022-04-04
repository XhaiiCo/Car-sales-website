<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white vh-100">
                <span class="fs-5 d-none d-sm-inline">Gestion</span>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="<?= $router->generate('admin_user') ?>" class="text-white nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Utilisateurs</span> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $router->generate('admin_ads') ?>" class="text-white nav-link px-0 align-middle">
                            <i class="fs-4 bi-cart"></i> <span class="ms-1 d-none d-sm-inline">Annonces</span> </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col py-3">