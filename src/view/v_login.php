<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <div id="error-container"></div>
                    <div class="mb-md-5 mt-md-3 pb-3">
                        <h2 class="fw-bold mb-3 text-uppercase">Connexion</h2>
                        <p class="text-white-30 mb-2">Veuillez saisir votre identifiant et mot de passe</p>
                        <form id="form" method="POST">
                            <div class="form-outline form-white mb-4">
                                <input name="mail" type="text" id="typeEmailX" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX">Email ou identifiant</label>
                            </div>

                            <div class="form-outline form-white mb-3">
                                <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX">Mot de passe</label>
                            </div>
                            <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Se connecter">
                        </form>
                    </div>
                    <div>
                        <p class="mb-0">Pas encore de compte? <a href="<?= $router->generate('inscription') ?>" class="text-white-50 fw-bold">Créer un compte</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "./model/model_login.php",
            dataType: "text",
            data: $(this).serialize(),
            success: function(data) {
                if (data === "1") {
                    window.location = "<?= $router->generate('home') ?>";
                } else {
                    divError = document.createElement("div");
                    $(divError).addClass("alert alert-danger");
                    $(divError).html("Identifiant ou mot de passe incorect")
                    $("#error-container").html(divError);
                }
            },
            error: function() {
                console.log("Error");
            }
        });
    });
</script>