<?php
if (!isConnected()) {
    exit();
}
?>

<div class="container">
    <header class="my-3">
        <h4>Paramètres du profil</h4>
        <h5>Modifiez les informations d'identification de votre compte</h5>
    </header>

    <div class="shadow p-3 mb-5 bg-light rounded">
        <form>
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
                <a href="#">Modifier mon mot de passe</a>
            </div>
            <hr>
            <input type="submit" value="Enregistrer les modifications" class="btn btn-primary my-2" disabled>
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
        $.ajax({
            url: "./model/model_current_user.php",
            dataType: "JSON",
            success: function(datas) {
                displayCurrentUser(datas);
            }
        });
    });

    function displayCurrentUser(datas) {
        user = datas[0];

        $("#mail").val(user.user_mail);
        $("#username").val(user.username);
    }
</script>