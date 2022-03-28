<?php require_once "./elements/header.php" ?>
<form id="form" class="">
    <h2>Inscription</h2>
    <div class="">
        <input type="text" name="username" id="name" class="input-text" placeholder="Nom d'utilisateur">
    </div>
    <div class="">
        <input type="email" name="email" id="email" class="input-text" placeholder="Adresse mail">
    </div>
    <div class="">
        <input type="password" name="password" id="password" class="input-text" placeholder="Mot de passe">
    </div>
    <div class="">
        <input type="password" name="comfirm-password" id="comfirm-password" class="input-text" placeholder="Confirmer mot de passe">
    </div>
    <div class="">
        <input type="submit" name="register" class="register" value="S'inscrire">
    </div>
</form>
<?php require_once "./elements/footer.php" ?>

<script>
    $("#form").submit(function(e) {
        e.preventDefault();
        console.log("here");
    });
</script>