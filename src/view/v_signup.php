<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <div id="feedback"></div>
                    <div class="mb-md-5 mt-md-3 pb-3">
                        <h2 class="fw-bold mb-4 text-uppercase">Inscription</h2>
                        <form id="form" method="POST">
                            <div class="form-outline form-white mb-4">
                                <input name="username" type="text" id="name" class="form-control form-control-lg" />
                                <label class="form-label" for="name">Nom d'utilisateur</label>
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input name="email" type="email" id="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input name="password" type="password" id="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Mot de passe</label>
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input name="confirm-password" type="password" id="confirm-password" class="form-control form-control-lg" />
                                <label class="form-label" for="confirm-password">Confirmez votre mot de passe</label>
                            </div>
                            <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Se connecter">
                        </form>
                    </div>
                    <div>
                        <p class="mb-0">Déjà un compte? <a href="<?= $router->generate('connexion') ?>" class="text-white-50 fw-bold">Se connecter</a></p>
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
            url: "./model/model_signup.php",
            dataType: "text",
            data: $(this).serialize(),
            success: function(response) {
                feedback = document.createElement("div");
                if (response === "ok") {
                    $(feedback).html("Votre compte a été créé avec succès");
                    $(feedback).addClass("alert alert-success");
                } else {
                    $(feedback).html(response);
                    $(feedback).addClass("alert alert-danger");
                }
                $("#feedback").html(feedback);
            },
            error: function() {
                console.log("Error");
            }
        });
    });
</script>

<style>
    body {
        background-image: url("./assets/img/site_elements/background/signup.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-color: darkgrey;
    }

    .card {
        background-color: rgba(17, 25, 40, 0.76);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.125);
    }
</style>