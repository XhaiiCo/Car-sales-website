<style>
    .item:hover {
        cursor: pointer;
        background-color: #f1eceb;
    }
</style>
<div class="container">


    <h1>
        Annonces
    </h1>
    <div class="row">
        <!-- filter form -->
        <div class="col-md-3 border-end">
            <form>
                <!-- List of brand -->
                <div class="form-group">
                    <label for="brand_select">Marque</label>
                    <select class="form-select" id="brand_select" name="brand_select">
                        <option value="%" selected>Toutes</option>
                    </select>
                </div>

                <!-- List of model -->
                <div class="form-group">
                    <label for="model_select">Modèle</label>
                    <select class="form-select" id="model_select" name="model_select" disabled>
                    </select>
                </div>

            </form>
        </div>
        <!-- List of sales -->
        <div class="col-md-9 ">
            <ul class="list-group list-group-flush" id="ads-container">
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        //Disable the model's select
        $("#model_select").prop("disabled", true);
        // display all the ads
        setAd();
        // put all the brand in the select
        setBrand();

    });

    //When the user select a brand :
    // - it filters the ads
    // - and displays the models in the select
    $("#brand_select").change(function() {
        $("#model_select").html("");
        if ($("#brand_select").val() != '%') {
            setModel();
        } else {
            $("#model_select").prop("disabled", true);
        }
        setAd();
    });

    $("#model_select").change(function() {
        setAd();
    });

    // Get ads from the db
    function setAd() {
        const brand = $("#brand_select").val();
        const model = $("#model_select").val() === null ? '%' : $("#model_select").val();
        $.ajax({
            type: "POST",
            url: "./model/model_ads.php",
            dataType: "JSON",
            data: {
                brand_select: brand,
                model_select: model
            },
            success: function(data) {
                displayAd(data);
            },
            error: function() {
                console.log("Error");
            },
            beforeSend: function() { //Loader
                $("#ads-container").html(" <div class = 'd-flex justify-content-center' ><div class = 'spinner-border' role = 'status' ><span class = 'visually-hidden'>Loading...< /span></div></div>");
            }
        });
    }

    //Display the ads past in argument
    function displayAd(data) {
        $("#ads-container").html("");

        if (data.length === 0) {
            divError = document.createElement("div");
            $(divError).addClass("alert alert-danger");
            $(divError).html("Il n'y a pas de voiture")
            $("#ads-container").append(divError);

        }

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
            $(img).attr("src", "./assets/img/car_on_sale/" + ad.picture_name);
            $(img).attr("alt", "Photo de " + ad.brand_name + " " + ad.model_name);
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
            $(pPrice).html(euro.format(ad.price));
            $(divPriceContainer).append(pPrice);

            $("#ads-container").append(li);
        }

        $(".item").click(function() {
            window.location = "annonce-" + this.id;
        });
    }

    // get brands from the db
    function setBrand() {
        $.ajax({
            type: "POST",
            url: "./model/model_brand.php",
            dataType: "JSON",
            success: function(data) {
                putBrand(data);
            },
            error: function() {
                console.log("Error");
            }
        });
    }

    // Put brands in the select
    function putBrand(brands) {
        for (brand of brands) {
            opt = document.createElement('option');
            $(opt).html(brand.brand_name);
            $(opt).attr("value", brand.brand_name);
            $("#brand_select").append(opt);
        }
    }

    // Get the list of model for the brand selected from the db
    function setModel() {
        $.ajax({
            type: "POST",
            url: "./model/model_car_model.php",
            dataType: "JSON",
            data: {
                brand_select: $("#brand_select").val()
            },
            success: function(data) {
                putModel(data);
            },
            error: function() {
                console.log("Error");
            }
        });
    }

    // Put models in the select
    function putModel(models) {
        $("#model_select").prop("disabled", false);
        $("#model_select").html("<option value='%' selected>Toutes</option>");
        for (model of models) {
            opt = document.createElement('option');
            $(opt).html(model.model_name);
            $(opt).attr("value", model.model_name);
            $("#model_select").append(opt);
        }
    }

    const euro = new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2
    });
</script>