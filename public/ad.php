<?php require_once "./template/header.php" ?>
<style>
    .item:hover {
        cursor: pointer;
        background-color: #f1eceb;
    }
</style>

<header class="container">
    <h1>Annonces</h1>
</header>


<main class="container">
    <div class="row">
        <!-- filter form -->
        <div class="col-md-3 border-right">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- List of sales -->
        <div class="col-md-9 ">
            <ul class="list-group list-group-flush" id="ad-container">

            </ul>
        </div>
</main>

<?php require_once "./template/footer.php" ?>

<script>
    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "../src/model/model_ad.php",
            dataType: "JSON",
            success: function(data) {
                displayAd(data);
            },
            error: function() {
                console.log("Erroe");
            }
        });
    });

    function displayAd(data) {
        console.log(data);
        for (var ad of data) {
            li = document.createElement("li");
            $(li).addClass("item list-group-item");
            $(li).attr("id", ad.id_sale);

            divContainer = document.createElement("div");
            $(divContainer).addClass("row");
            $(li).append(divContainer);

            divImgContainer = document.createElement("div");
            $(divImgContainer).addClass("col-lg-4 col-md-12 mb-4 mb-lg-0");
            $(divContainer).append(divImgContainer);

            img = document.createElement("img");
            $(img).addClass("img-fluid rounded img-responsive");
            $(img).attr("src", "../src/assets/img/car_on_sale/" + ad.picture_name);
            $(img).attr("alt", "Photo de " + ad.brand_name + " " + ad.model_name)
            $(divImgContainer).append(img);

            divInfoContainer = document.createElement("div");
            $(divInfoContainer).addClass("col");
            $(divContainer).append(divInfoContainer);

            divNamePriceContainer = document.createElement("div");
            $(divNamePriceContainer).addClass("col");
            $(divInfoContainer).append(divNamePriceContainer);

            divNameContainer = document.createElement("div");
            $(divNameContainer).addClass("row");
            $(divNamePriceContainer).append(divNameContainer);

            h1Name = document.createElement("h1");
            $(h1Name).html(ad.brand_name + " " + ad.model_name);
            $(divNameContainer).append(h1Name);

            divPriceContainer = document.createElement("div");
            $(divPriceContainer).addClass("row");
            $(divNamePriceContainer).append(divPriceContainer);

            pPrice = document.createElement("p");
            $(pPrice).addClass("text-warning");
            $(pPrice).html(ad.price + " €");
            $(divPriceContainer).append(pPrice);

            $("#ad-container").append(li);
        }



        //Template
        // <li class="item list-group-item">
        //     <div class="row">
        //         <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
        //             <img class="img-fluid rounded img-responsive" src="https://cdn.motor1.com/images/mgl/1ALLW/s3/2019-mercedes-amg-g63-edition-1.jpg">
        //         </div>
        //         <div class="col">
        //             <div class="col">
        //                 <div class="row">
        //                     <h1>Mercedes G 63 AMG</h1>
        //                 </div>
        //                 <div class="row">
        //                     <p class="text-warning">109 000 €</p>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        // </li>

    }
</script>