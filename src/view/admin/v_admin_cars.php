<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>
<!-- remove modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-text" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button id="btn-delete-modal" type="button" class="btn btn-danger" data-bs-dismiss="modal">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- new brand modal -->
<div class="modal fade" id="newBrandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une marque</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-text" class="modal-body">
                <input type="text" placeholder="Entrez le nom de la marque" class="form-control" name="newBrandName" id="newBrandName">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button id="btn-add-brand" type="button" class="btn btn-success" data-bs-dismiss="modal">Ajouter</button>
            </div>
        </div>
    </div>
</div>

<!-- new model modal -->
<div class="modal fade" id="newModelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un modèle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-text" class="modal-body">
                <!-- List of brand -->
                <div class="form-group">
                    <label for="brand_select">Marque</label>
                    <select class="form-select" id="brandNewModel" name="brandNewModel">
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Entrez le nom du modèle" class="form-control" name="newModelName" id="newModelName">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button id="btn-add-model" type="button" class="btn btn-success" data-bs-dismiss="modal">Ajouter</button>
            </div>
        </div>
    </div>
</div>


<div id="feedback"></div>
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newBrandModal">Ajouter une marque</button>
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newModelModal">Ajouter un modèle</button>

<h3 class="text-center my-3">Gestion des véhicules</h3>

<!-- Form -->
<div class="container my-4">
    <div class="row">
        <form id="form">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="input-group">
                    <input id="q" type="text" class="form-control" name="q" placeholder="Rechercher...">
                    <div class="input-group-btn search-panel">
                        <select id="brand" name="brand" class="form-select" aria-label="Default select example">
                        </select>
                    </div>
                    <button id="searchBtn" type="submit" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Rechercher</span></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ads table -->
<div class="container">
    <div class="row">
        <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                            <tr>
                                <th>Marque</th>
                                <th>Modèle</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="ads-container">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./js/app.js"></script>
<script>
    $(document).ready(function() {
        actuAds();
        setBrand();
    });

    function actuAds() {
        const q = $("#q").val();
        const brand = $("#brand").val() === null ? "%" : $("#brand").val();
        console.log(brand);
        const seller = "<?= getEmail() ?>";
        $.ajax({
            type: "POST",
            url: "./model/model_car.php",
            dataType: "json",
            data: {
                q: q,
                brand: brand
            },
            success: function(datas) {
                displayCars(datas);
            }
        });

    }

    function displayCars(datas) {
        $("#ads-container").html("");

        for (var data of datas) {
            tr = document.createElement("tr");

            tdBrand = document.createElement("td");
            $(tdBrand).html(data.brand_name);
            tr.append(tdBrand);

            tdModel = document.createElement("td");
            $(tdModel).html(data.model_name);
            tr.append(tdModel);


            tdBtnContainer = document.createElement("td");
            $(tdBtnContainer).attr("style", "width:20%");

            spanDelete = document.createElement("span");
            $(spanDelete).attr("data-bs-toggle", "modal");
            $(spanDelete).attr("data-bs-target", "#deleteModal");
            $(spanDelete).attr("class", "btn-delete table-link text-danger fa-stack");
            $(spanDelete).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> ");
            $(spanDelete).attr("brand", data.brand_name);
            $(spanDelete).attr("model", data.model_name);

            tdBtnContainer.append(spanDelete);
            tr.append(tdBtnContainer);
            $("#ads-container").append(tr);
        }

        $(".btn-delete").click(function() {
            $("#modal-text").html("Êtes-vous sur de vouloir supprimer " + $(this).attr("brand") + " " + $(this).attr("model") + " ?");
            $("#deleteModal").attr("brand", $(this).attr("brand"));
            $("#deleteModal").attr("model", $(this).attr("model"));
        });
    }

    $("#btn-delete-modal").click(function() {
        $.ajax({
            type: "POST",
            url: "./model/admin/model_remove_car.php",
            dataType: "JSON",
            data: {
                brand: $("#deleteModal").attr("brand"),
                model: $("#deleteModal").attr("model")
            },
            success: function(response) {
                displayFeedback("feedback", response);
                actuAds();
            }
        });
    });

    $("#form").submit(function(e) {
        e.preventDefault();
        actuAds();
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
                console.log("Error");
            }
        });
    }

    // Put brands in the select
    function putBrand(brands) {
        $("#brand").html("<option selected value='%'>Toutes</option>");
        for (brand of brands) {
            opt = document.createElement('option');
            $(opt).html(brand.brand_name);
            $(opt).attr("value", brand.brand_name);
            $("#brand").append(opt);
            opt2 = opt.cloneNode(true);
            $("#brandNewModel").append(opt2);
        }
    }

    $("#btn-add-brand").click(function() {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {
                brand: $("#newBrandName").val()
            },
            url: "./model/admin/model_new_brand.php",
            success: function(response) {
                displayFeedback("feedback", response);
                if (response.success === 1) {
                    actuAds();
                    setBrand();
                }
            }
        });
    });

    $("#btn-add-model").click(function() {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {
                brand: $("#brandNewModel").val(),
                model: $("#newModelName").val()
            },
            url: "./model/admin/model_new_model.php",
            success: function(response) {
                displayFeedback("feedback", response);
                if (response.success === 1) {
                    actuAds();
                    setBrand();
                }
            }
        });
    });
</script>

<style>
    .table thead tr th {
        text-transform: uppercase;
        font-size: 0.875em;
    }

    .table thead tr th {
        border-bottom: 2px solid #e7ebee;
    }

    .table tbody tr td {
        font-size: 0.875em;
        vertical-align: middle;
        border-top: 1px solid #e7ebee;
        padding: 12px 8px;
    }

    span {
        cursor: pointer;
    }
</style>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>