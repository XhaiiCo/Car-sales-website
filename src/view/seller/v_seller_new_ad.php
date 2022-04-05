<?php require_once "../src/view/seller/elements/v_seller_sidebar.php"; ?>
<h3 class="text-center my-3">Nouvelle annonce</h3>

<div class="container">
    <div id="feedback"></div>
    <form id="form">
        <!-- List of brand -->
        <div class="form-group">
            <label for="brand_select">Marque</label>
            <select class="form-select" id="brand_select" name="brand_select">
                <option value="%">Marque</option>
            </select>
        </div>

        <!-- List of model -->
        <div class="form-group">
            <label for="model_select">Modèle</label>
            <select class="form-select" id="model_select" name="model_select">
            </select>
        </div>

        <!-- additional info -->
        <div class="form-group">
            <label for="additional_info">information additionnelle</label>
            <input class="form-control" type="text" id="additional_info" name="additional_info" placeholder="Ex: sièges sport, ABS...">
        </div>

        <!-- price -->
        <div class="form-group">
            <label for="price">Prix de vente</label>
            <input class="form-control" type="text" id="price" name="price" min="0">
        </div>

        <!-- sale_description -->
        <div class="form-group">
            <label for="sale_description">Description</label>
            <textarea class="form-control" name="sale_description" id="sale_description"></textarea>
        </div>

        <div class="form-group">
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
                        <th scope="row">Kilométrage</th>
                        <td>
                            <input class="form-control" type="number" id="car_kilometer" name="car_kilometer" min="0">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Année</th>
                        <td>
                            <input class="form-control" type="number" id="car_year" name="car_year" min="0">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Puissance</th>
                        <td>
                            <input class="form-control" type="number" id="car_power" name="car_power" min="0">
                        </td>
                    </tr>
                    <tr>
                        <th scope=" row">Carburant</th>
                        <td>
                            <input class="form-control" type="text" id="car_fuel" name="car_fuel">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">État</th>
                        <td>
                            <input class="form-control" type="text" id="car_state" name="car_state">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Couleur extérieure</th>
                        <td>
                            <input class="form-control" type="text" id="car_color" name="car_color">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            Entrez les images de votre voiture (au moins une image)
                        <th>
                    </tr>
                </thead>
                <tbody id="img_form_container">
                    <tr id="img-input-1">
                        <th>Image 1</th>
                        <td>
                            <input number="1" class='form-control' type='file' name='car_img_1'>
                        </td>
                    <tr>
                </tbody>
            </table>
        </div>
        <input type="submit" value="Ajouter" class="btn btn-primary">
    </form>
</div>

<?php require_once "../src/view/seller/elements/v_seller_ender.php"; ?>


<!-- add the ad -->
<script>
    $(document).ready(function() {
        $("#form").submit(function(e) {
            e.preventDefault();

            let form_data = new FormData(this);
            $.ajax({
                type: "POST",
                url: "./model/model_new_ad.php",
                dataType: "JSON",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
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
            });
        })
    })
</script>

<!-- Set the data -->
<script>
    $(document).ready(function() {
        // put all the brand in the select
        setImgForm();
        setBrand();
        $("#model_select").html("<option value='%'>veuillez sélectionner une marque</option>");
    });

    function setImgForm() {
        for (i = 2; i <= 7; i++) {
            html =
                " <tr id='img-input-" + i + "'  style='display: none;'> \
                    <th>Image " + i + "</th> \
                    <td> \
                        <input number='" + i + "' class='form-control' type='file' name='car_img_" + i + "'> \
                    </td> \
                <tr> \
                ";
            $("#img_form_container").append(html);
        }

        $("input[type='file']").change(function() {
            const inputNumber = parseInt($(this).attr("number")) + 1;
            if (inputNumber <= 7) {
                $("#img-input-" + inputNumber).show();
            }
        });
    }

    //When the user select a brand :
    // - it filters the ads
    // - and displays the models in the select
    $("#brand_select").change(function() {
        $("#model_select").html("");
        if ($("#brand_select").val() != "%")
            setModel();
        else {
            $("#model_select").html("<option value='%'>veuillez sélectionner une marque</option>");
        }
    });

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
                console.log("Error setBrand");
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
        for (model of models) {
            opt = document.createElement('option');
            $(opt).html(model.model_name);
            $(opt).attr("value", model.model_name);
            $("#model_select").append(opt);
        }
    }
</script>