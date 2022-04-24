<?php if (isConnected()) : ?>
    <!-- candidacy modal -->
    <div class="modal fade" id="contactModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Contacter le vendeur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="message" placeholder="Entrez votre message"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="sendMessage" data-bs-dismiss="modal">Envoyer votre message</button>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- Connexion modal -->
    <div class="modal fade" id="connexionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contacter le vendeur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Vous devez être connecté pour pouvoir contacter des vendeurs
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <a href="<?= $router->generate("connexion") ?>" type="button" class="btn btn-primary">Se connecter</a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<div class="p-2 container">
    <div id="feedback"></div>

    <a class="nav-link link-dark" href="<?= $router->generate("annonces") ?>">
        <i class="bi bi-arrow-left"></i> Revenir aux annonces
    </a>

    <div class="row">
        <div class="col-md-7">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div id="carousel-btn" class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                </div>
                <div id="carousel-img" class="carousel-inner">
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <h1 id="car_name"></h1>
            </div>
            <div class="row">
                <h3 id="additional_info"></h3>
            </div>
            <div class="row p-2">
                <h2 id="car_price" class="text-warning"></h2>
            </div>
            <div class="row">
                <p id="sale_description" class="description"></p>
                <span class="showMore">Voir plus</span>
            </div>

            <div class="row">
                <hr>
                <p>Vendu par</p>
                <p id="seller"></p>
                <hr>
            </div>

            <div>
                <?php if (isConnected()) : ?>
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#contactModal">Contacter le vendeur</button>
                <?php else : ?>
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#connexionModal">Contacter le vendeur</button>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            Description
                        <th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th scope="row">date de publication</th>
                        <td id="publication_date"></td>

                    </tr>
                    <tr>
                        <th scope="row">Kilométrage</th>
                        <td id="car_kilometer"></td>
                    </tr>
                    <tr>
                        <th scope="row">Année</th>
                        <td id="car_year"></td>
                    </tr>
                    <tr>
                        <th scope="row">Puissance</th>
                        <td id="car_power"></td>
                    </tr>
                    <tr>
                        <th scope=" row">Carburant</th>
                        <td id="car_fuel"></td>
                    </tr>
                    <tr>
                        <th scope="row">État</th>
                        <td id="car_state"></td>
                    </tr>
                    <tr>
                        <th scope="row">Couleur extérieure</th>
                        <td id="car_color"></td>
                    </tr>
                </tbody>

            </table>
        </div>

    </div>

</div>

<script type="text/javascript" src="./js/app.js"></script>
<script>
    const id = <?= $id ?>;
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./model/model_ad.php",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(datas) {
                putData(datas);
            },
            error: function(e) {
                console.log("Error");
            }
        });

        $.ajax({
            type: "POST",
            url: "./model/model_car_picture.php",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(datas) {
                putPicture(datas);
            },
            error: function() {
                console.log("Error");
            }
        });
    });

    function putData(datas) {
        data = datas[0];
        //Car name
        $("#car_name").html(data.brand_name + " " + data.model_name);
        $("#additional_info").html(data.additional_info);
        $("#car_price").html(euro.format(data.price))

        $("#publication_date").html(data.publication_date)
        $("#car_kilometer").html(data.car_kilometer + " km");
        $("#car_year").html(data.car_year);
        $("#car_power").html(data.car_power + " CH");
        $("#car_fuel").html(data.car_fuel);
        $("#car_state").html(data.car_state);
        $("#car_color").html(data.car_color);
        $("#sale_description").html(data.sale_description);
        if (data.sale_description.length <= 212) {
            $("#sale_description").addClass("displayed");
            $(".showMore").hide();
        }
        $("#seller").html(data.username);
    }

    function putPicture(datas) {
        for (var i = 1; i < datas.length; i++) {
            $("#carousel-btn").append("<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" + i + "'></button>");
        }
        var i = 1;
        for (data of datas) {
            if (i === 1) {
                $("#carousel-img").append("<div class='carousel-item active'> <img src = './assets/img/car_on_sale/" + data.picture_name + "'class = 'd-block w-100'></div>");
                i++;
            } else {
                $("#carousel-img").append("<div class='carousel-item'> <img src = './assets/img/car_on_sale/" + data.picture_name + "'class = 'd-block w-100'></div>");
            }
        }
    }

    const euro = new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2
    });


    $(".showMore").click(function() {
        $("#sale_description").toggleClass('displayed');
        if ($(".showMore").html() === "Voir plus") {
            $(".showMore").html("Voir moins");
        } else {
            $(".showMore").html("Voir plus");
        }

    })
</script>

<?php if (isConnected()) : ?>
    <script>
        $("#sendMessage").click(function() {
            console.log(<?= $id ?> + " " + $("#message").val());

            $.ajax({
                type: "post",
                dataType: "json",
                data: {
                    id: <?= $id ?>,
                    message: $("#message").val()
                },
                url: "./model/logged_user/model_send_message.php",
                success: function(response) {
                    displayFeedback("feedback", response);
                }
            });
        });
    </script>
<?php endif; ?>

<style>
    .description {
        height: 70px;
        overflow: hidden;
        margin-bottom: 3px;
        text-align: justify;
    }

    .displayed {
        height: auto;
    }

    .showMore {
        cursor: pointer;
        text-decoration: underline;
    }

    textarea {
        width: 100%;
        border-radius: 5px;
        border: 1px solid grey;
    }
</style>