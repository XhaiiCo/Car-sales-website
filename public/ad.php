<?php require_once "./template/header.php" ?>
<div class="container p-2">
    <div class="row">
        <div class="col-md-7">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../src/assets/img/car_on_sale/1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../src/assets/img/car_on_sale/2.jpg" class="d-block w-100" alt="...">
                    </div>
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
                <h1>Mercedes-Benz G 63 AMG</h1>
            </div>
            <div class="row p-2">
                <h2 class="text-warning">80 000 €</h2>
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
                        <td>2022-03-22</td>

                    </tr>
                    <tr>
                        <th scope="row">Kilométrage</th>
                        <td>23 932</td>
                    </tr>
                    <tr>
                        <th scope="row">Année</th>
                        <td>2010</td>
                    </tr>
                    <tr>
                        <th scope="row">Puissance</th>
                        <td>544 CH</td>
                    </tr>
                    <tr>
                        <th scope="row">Carburant</th>
                        <td>Essence</td>
                    </tr>
                    <tr>
                        <th scope="row">État</th>
                        <td>Occasion</td>
                    </tr>
                    <tr>
                        <th scope="row">Couleur extérieure</th>
                        <td>Noir</td>
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
</script>

<script>
    console.log(id);
</script>
<?php require_once "./template/footer.php" ?>