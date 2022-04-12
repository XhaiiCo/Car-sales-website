<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>
<!-- remove modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div id="feedback"></div>
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
                            <option selected value="%">Toutes</option>
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
<script>
    $(document).ready(function() {
        actuAds();
        setBrand();
    });

    function actuAds() {
        const q = $("#q").val();
        const brand = $("#brand").val();
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
                displayUser(datas);
            }
        });

    }

    function displayUser(datas) {
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
        for (brand of brands) {
            opt = document.createElement('option');
            $(opt).html(brand.brand_name);
            $(opt).attr("value", brand.brand_name);
            $("#brand").append(opt);
        }
    }
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

    .table a:hover {
        text-decoration: none;
    }
</style>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>