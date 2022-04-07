<?php
if (!isConnected()) {
    exit();
}
?>

<!-- Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier votre mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="password_form">
                <div class="modal-body">
                    <input name="current_password" class="form-control my-2" type="password" placeholder="Mot de passe actuel">
                    <input name="new_password" class="form-control my-2" type="password" placeholder="Votre nouveau mot de passe">
                    <input name="confirme_new_password" class="form-control my-2" type="password" placeholder="Confirmez votre nouveau mot de passe">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=" container">
    <header class="my-3">
        <div id="feedback"></div>
        <h4>Paramètres du profil</h4>
        <h5>Modifiez les informations d'identification de votre compte</h5>
    </header>

    <div class="shadow p-3 mb-5 bg-light rounded">
        <form id="form">
            <div class="form-group">
                <h6>Nom d'utilisateur</h6>
                <input name="username" id="username" type="text" class="form-control">
            </div>
            <hr>
            <div class="form-group">
                <h6>Adresse email</h6>
                <input name="mail" id="mail" type="mail" class="form-control">
            </div>
            <hr>
            <div class="form-group">
                <h6>Mot de passe</h6>
                <a href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">Modifier mon mot de passe</a>
            </div>
            <hr>
            <input type="submit" value="Enregistrer les modifications" class="btn btn-primary my-2">
        </form>

    </div>
    <div class="">
        <?php if (!isSeller()) : ?>
            <button class="btn btn-secondary">Devenir vendeur</button>
        <?php endif ?>
        <button class="btn btn-danger">Supprimer mon compte</button>
    </div>
</div>


<script>
    $(document).ready(function() {
        putUserData();
        $("#form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                data: $(this).serialize(),
                dataType: "JSON",
                url: "./model/model_update_current_user.php",
                success: function(response) {
                    displayFeedback(response);
                },
                error: function() {
                    console.log("Error");
                }
            });
        });

        $("#password_form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                data: $(this).serialize(),
                dataType: "JSON",
                url: "./model/model_update_user_password.php",
                success: function(response) {
                    displayFeedback(response);
                },
                error: function() {
                    console.log("Error");
                }
            });
        });
    });

    function putUserData() {
        $.ajax({
            url: "./model/model_current_user.php",
            dataType: "JSON",
            success: function(datas) {
                displayCurrentUser(datas);
            }
        });
    }

    function displayCurrentUser(datas) {
        user = datas[0];

        $("#mail").val(user.user_mail);
        $("#username").val(user.username);
    }

    function displayFeedback(response) {
        if (response.error === 1) {
            divError = document.createElement("div");
            $(divError).addClass("alert alert-danger");
            $(divError).html(response.em)
            $("#feedback").html(divError);
        } else if (response.success === 1) {
            divSuccess = document.createElement("div");
            $(divSuccess).addClass("alert alert-success");
            $(divSuccess).html(response.sm)
            $("#feedback").html(divSuccess);
        }
    }
</script>