<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>

<style>
    .table a.table-link.danger {
        color: #e74c3c;
    }

    .label {
        font-size: 0.875em;
        font-weight: 600;
    }

    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
    }

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
</style>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th><span>Utilisateur</span></th>
                                    <th><span>Creation</span></th>
                                    <th><span>Rôle</span></th>
                                    <th><span>Email</span></th>
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
</div>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>


<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "../src/model/model_user.php",
            dataType: "json",
            success: function(datas) {
                displayUser(datas);
            }
        });

        $(".remove").click(function() {
            console.log("here");
        });
    });


    function displayUser(datas) {
        for (data of datas) {
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
            $(spanModif).attr("style", "table-link text-info fa-stack");
            $(spanModif).html("<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-pencil fa-stack-1x fa-inverse'></i> ");

            tdBtnContainer.append(spanModif);
            tr.append(tdBtnContainer);

            const html =
                "                    <tr> \
                                    <td> " + data.username + "</td> \
                                    <td> " + data.date_registration + "</td> \
                                    <td> " + role + "</td> \
                                    <td>" + data.user_mail + "</td> \
                                    <td style='width: 20%;'> \
                                        <span class='table-link text-info fa-stack'> \
                                            <i class='fa fa-square fa-stack-2x'></i> \
                                            <i class='fa fa-pencil fa-stack-1x fa-inverse'></i> \
                                        </span> \
                                        <span class='table-link text-danger fa-stack'> \
                                            <i class='fa fa-square fa-stack-2x'></i> \
                                            <i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> \
                                        </span> \
                                    </td> \
                                </tr> \
                                ";
            $("#user-container").append(tr);

        }

    }
</script>