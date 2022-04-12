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

<!-- Form -->
<h3 class="text-center my-3">Gestion des annonces</h3>
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

<!-- ads table -->
<div class="container">
    <div class="row">
        <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                            <tr>
                                <th>Véhicule</th>
                                <th>Année</th>
                                <th>Publication</th>
                                <th>Vendeur</th>
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
    });

    function actuAds() {
        const q = $("#q").val();
        const seller = "<?= getEmail() ?>";
        $.ajax({
            type: "POST",
            url: "./model/admin_seller/model_seller_ads.php",
            dataType: "json",
            data: {
                q: q,
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

            tdCar = document.createElement("td");
            // $(tdCar).html("<img src='./assets/img/car_on_sale/" + data.picture_name + "'>" + data.brand_name);
            aCar = document.createElement("a");
            $(aCar).attr("href", "annonce-" + data.id_sale);
            $(aCar).attr("class", "link-dark");
            $(aCar).html(data.brand_name + " " + data.model_name);
            $(tdCar).append(aCar);
            tr.append(tdCar);

            tdYear = document.createElement("td");
            $(tdYear).html(data.car_year);
            tr.append(tdYear);

            tdDatePublished = document.createElement("td");
            $(tdDatePublished).html(data.publication_date);
            tr.append(tdDatePublished);

            tdSeller = document.createElement("td");
            $(tdSeller).html(data.username);
            tr.append(tdSeller);

            tdBtnContainer = document.createElement("td");
            $(tdBtnContainer).attr("style", "width:20%");

            spanDelete = document.createElement("span");
            $(spanDelete).attr("data-bs-toggle", "modal");
            $(spanDelete).attr("data-bs-target", "#deleteModal");
            $(spanDelete).attr("class", "btn-delete table-link text-danger fa-stack");
            $(spanDelete).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> ");
            $(spanDelete).attr("id", data.id_sale);

            tdBtnContainer.append(spanDelete);
            tr.append(tdBtnContainer);
            $("#ads-container").append(tr);
        }
        $(".btn-delete").click(function() {
            $("#modal-text").html("Êtes-vous sur de vouloir supprimer cette annonce ?");
            $("#deleteModal").attr("ad", this.id);
        });
    }



    $("#btn-delete-modal").click(function() {
        $.ajax({
            type: "POST",
            url: "./model/admin_seller/model_remove_ad.php",
            data: {
                id: $("#deleteModal").attr("ad")
            },
            success: function() {
                actuAds();
            }
        });
    });

    $("#form").submit(function(e) {
        e.preventDefault();
        actuAds();
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

    .table a:hover {
        text-decoration: none;
    }
</style>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>