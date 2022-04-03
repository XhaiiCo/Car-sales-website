<?php require_once "../src/view/seller/elements/v_seller_sidebar.php"; ?>

<!-- remove modal -->
<div class="modal fade" id="validModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Form -->
<h3 class="text-center my-3">Gestion de mes annonces</h3>
<div class="container my-4">
    <div class="row">
        <form id="form">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="input-group">
                    <input id="q" type="text" class="form-control" name="q" placeholder="Rechercher...">
                    <button id="searchBtn" type="submit" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Rechercher</span></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Users table -->
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
                                <th>Année</th>
                                <th>Publication</th>
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
<?php require_once "../src/view/seller/elements/v_seller_ender.php"; ?>


<script>
    $(document).ready(function() {
        actuAds();
    });

    function actuAds() {
        const q = $("#q").val();
        const seller = "<?= getUsername() ?>";

        $.ajax({
            type: "POST",
            url: "./model/model_seller_ads.php",
            dataType: "json",
            data: {
                q: q,
                seller: seller
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
            // $(tdBrand).html("<img src='./assets/img/car_on_sale/" + data.picture_name + "'>" + data.brand_name);
            $(tdBrand).html(data.brand_name);
            tr.append(tdBrand);

            tdModel = document.createElement("td");
            $(tdModel).html(data.model_name);
            tr.append(tdModel);

            tdYear = document.createElement("td");
            $(tdYear).html(data.car_year);
            tr.append(tdYear);

            tdDatePublished = document.createElement("td");
            $(tdDatePublished).html(data.publication_date);
            tr.append(tdDatePublished);

            tdBtnContainer = document.createElement("td");
            $(tdBtnContainer).attr("style", "width:20%");

            spanModif = document.createElement("span");
            $(spanModif).attr("data-bs-toggle", "modal");
            $(spanModif).attr("data-bs-target", "#updateModal");
            $(spanModif).attr("class", "btn-modif table-link text-info fa-stack");
            $(spanModif).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-pencil fa-stack-1x fa-inverse'></i> ");
            $(spanModif).attr("id", data.id_sale);

            tdBtnContainer.append(spanModif);
            spanDelete = document.createElement("span");
            $(spanDelete).attr("data-bs-toggle", "modal");
            $(spanDelete).attr("data-bs-target", "#validModal");
            $(spanDelete).attr("class", "btn-delete table-link text-danger fa-stack");
            $(spanDelete).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> ");
            $(spanDelete).attr("id", data.id_sale);

            tdBtnContainer.append(spanDelete);
            tr.append(tdBtnContainer);
            $("#ads-container").append(tr);
        }

        $(".btn-modif").click(function() {
            console.log("modif : ", this.id);
        });

        $(".btn-delete").click(function() {
            console.log("delete : ", this.id);
        });

        $("#btn-delete-modal").click(function() {});

        $("#btn-confirm-update-modal").click(function() {});

        $("#form").submit(function(e) {
            e.preventDefault();
            actuAds();
        });
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
</style>