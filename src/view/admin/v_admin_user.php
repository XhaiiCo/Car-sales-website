<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>


<!-- Form -->
<h3 class="text-center my-3">Gestion des utilisateurs</h3>
<div class="container my-4">
    <div class="row">
        <form id="form">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="input-group">
                    <input id="q" type="text" class="form-control" name="q" placeholder="Rechercher...">
                    <div class="input-group-btn search-panel">
                        <select id="role" name="role" class="form-select" aria-label="Default select example">
                            <option selected value="all">Tous</option>
                            <option value="user">Utilisateurs</option>
                            <option value="seller">Vendeurs</option>
                            <option value="admin">Admins</option>
                        </select>
                    </div>
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
                                <th>Utilisateur</th>
                                <th>Creation</th>
                                <th>Rôle</th>
                                <th>Email</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="user-container">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>


<script>
    $(document).ready(function() {
        actuUser();
    });

    function actuUser() {
        const q = $("#q").val();
        const role = $("#role").val();

        $.ajax({
            type: "POST",
            url: "../src/model/model_user.php",
            dataType: "json",
            data: {
                q: q,
                role: role
            },
            success: function(datas) {
                displayUser(datas);
            }
        });

        $(".remove").click(function() {
            console.log("here");
        });
    }

    function displayUser(datas) {
        $("#user-container").html("");

        for (var data of datas) {
            var role = "Utilisateur";
            if (data.isAdmin === "1") {
                role += ", Admin";
            }
            if (data.isSeller === "1") {
                role += ", Vendeur"
            }

            tr = document.createElement("tr");

            tdUsername = document.createElement("td");
            $(tdUsername).html(data.username);
            tr.append(tdUsername);

            tdDate = document.createElement("td");
            $(tdDate).html(data.date_registration);
            tr.append(tdDate);

            tdRole = document.createElement("td");
            $(tdRole).html(role);
            tr.append(tdRole);

            tdEmail = document.createElement("td");
            $(tdEmail).html(data.user_mail);
            tr.append(tdEmail);

            tdBtnContainer = document.createElement("td");
            $(tdBtnContainer).attr("style", "width:20%");

            spanModif = document.createElement("span");
            $(spanModif).attr("class", "btn-modif table-link text-info fa-stack");
            $(spanModif).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-pencil fa-stack-1x fa-inverse'></i> ");
            $(spanModif).attr("id", data.user_mail);

            tdBtnContainer.append(spanModif);

            spanDelete = document.createElement("span");
            $(spanDelete).attr("class", "btn-delete table-link text-danger fa-stack");
            $(spanDelete).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> ");
            $(spanDelete).attr("id", data.user_mail);

            tdBtnContainer.append(spanDelete);
            tr.append(tdBtnContainer);
            $("#user-container").append(tr);

            $(".btn-modif").click(function() {
                console.log("modif : " + this.id);
            });

            $(".btn-delete").click(function() {
                console.log("delete : " + this.id);
            });
        }

        $("#form").submit(function(e) {
            e.preventDefault();
            actuUser();
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