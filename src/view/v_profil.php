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

    <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h6>Nom d'utilisateur</h6>
        <hr>
        <h6>Adresse email</h6>
        <hr>
        <h6>Mot de passe</h6>
    </div>
    <div class="">
        <button class="btn btn-secondary">Devenir vendeur</button>
        <button class="btn btn-danger">Supprimer mon compte</button>
    </div>
</div>