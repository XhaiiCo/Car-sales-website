<?php require_once "./elements/header.php" ?>
<section class="gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-3 pb-3">
                            <h2 class="fw-bold mb-3 text-uppercase">Connexion</h2>
                            <p class="text-white-30 mb-2">Veuillez saisir votre identifiant et mot de passe</p>

                            <div class="form-outline form-white mb-4">
                                <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX">Email</label>
                            </div>

                            <div class="form-outline form-white mb-3">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX">Mot de passe</label>
                            </div>
                            <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Se connecter">
                        </div>
                        <div>
                            <p class="mb-0">Pas encore de compte? <a href="#!" class="text-white-50 fw-bold">Créer un compte</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once "./elements/footer.php" ?>