<div id="feedback"></div>
<form id="form" class="">
    <h2>Inscription</h2>
    <div class="">
        <input required type="text" name="username" id="name" class="input-text" placeholder="Nom d'utilisateur">
    </div>
    <div class="">
        <input required type="email" name="email" id="email" class="input-text" placeholder="Adresse mail">
    </div>
    <div class="">
        <input required type="password" name="password" id="password" class="input-text" placeholder="Mot de passe">
    </div>
    <div class="">
        <input required type="password" name="comfirm-password" id="comfirm-password" class="input-text" placeholder="Confirmer mot de passe">
    </div>
    <div class="">
        <input required type="submit" name="register" class="register" value="S'inscrire">
    </div>
</form>
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