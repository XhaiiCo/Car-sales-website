<?php require_once "./template/header.php" ?>
<div class="container p-2">
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
            <div class="row p-2">
                <h2 id="car_price" class="text-warning">80 000 €</h2>
            </div>
            <div class="row">
                <p id="sale_description"></p>
            </div>

            <div class="row">
                <hr>
                <p>Vendu par</p>
                <p id="seller"></p>
                <hr>
            </div>

            <div>
                <input class="btn btn-secondary" type="button" value="Contacter le vendeur">
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

<script>
    let searchParams = new URLSearchParams(window.location.search);
    const id = searchParams.get('id');
    if (!searchParams.has('id')) {
        window.location = " index.php";
    }

    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "../src/model/model_ad.php",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(datas) {
                putData(datas);
            },
            error: function() {
                console.log("Error");
            }
        });

        $.ajax({
            type: "POST",
            url: "../src/model/model_car_picture.php",
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
        $("#car_price").html(euro.format(data.price))

        $("#publication_date").html(data.publication_date)
        $("#car_kilometer").html(data.car_kilometer + " km");
        $("#car_year").html(data.car_year);
        $("#car_power").html(data.car_power + " CH");
        $("#car_fuel").html(data.car_fuel);
        $("#car_state").html(data.car_state);
        $("#car_color").html(data.car_color);
        $("#sale_description").html(data.sale_description);
        $("#seller").html(data.username);
    }

    function putPicture(datas) {
        for (var i = 1; i < datas.length; i++) {
            $("#carousel-btn").append("<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" + i + "'></button>");
        }
        var i = 1;
        for (data of datas) {
            if (i === 1) {
                $("#carousel-img").append("<div class='carousel-item active'> <img src = '../src/assets/img/car_on_sale/" + data.picture_name + "'class = 'd-block w-100'></div>");
                i++;
            } else {
                $("#carousel-img").append("<div class='carousel-item'> <img src = '../src/assets/img/car_on_sale/" + data.picture_name + "'class = 'd-block w-100'></div>");
            }
        }
    }

    const euro = new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2
    });
</script>
<?php require_once "./template/footer.php" ?>