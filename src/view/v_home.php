<main>
    <div class="img img1">

    </div>

    <div class="container test col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">DLMotors</h1>
                <p class="lead">Si vous souhaitez acheter, revendre ou simplement explorer les véhicules vous êtes au bon endroit.</p>
                <?php if (!isConnected()) : ?>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="<?= $router->generate('connexion') ?>" class=" btn btn-secondary btn-lg px-4 me-md-2">Connexion</a>
                        <a href="<?= $router->generate('inscription') ?>" class=" btn btn-outline-secondary btn-lg px-4">Inscription</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>Ce site est un projet scolaire. Il est donc fictif</p>
    </footer>
</main>

<style>
    .img {
        height: 600px;
        background-image: url("./assets/img/site_elements/banner/home_banner.jpg");
        background-size: cover;
        background-attachment: fixed;
        background-position: center;

    }
</style>