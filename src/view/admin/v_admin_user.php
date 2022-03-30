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
                                    <th class="text-center"><span>Rôle</span></th>
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
            const html =
                "                    <tr> \
                                    <td> " + data.username + "</td> \
                                    <td> " + data.date_registration + "</td> \
                                    <td class='text-center'> \
                                        <span class='label label-default'>" + role + "</span> \
                                    </td> \
                                    <td>" + data.user_mail + "</td> \
                                    <td style='width: 20%;'> \
                                        <a href='#' class='table-link text-info'> \
                                            <span class='fa-stack'> \
                                                <i class='fa fa-square fa-stack-2x'></i> \
                                                <i class='fa fa-pencil fa-stack-1x fa-inverse'></i> \
                                            </span> \
                                        </a> \
                                        <a href='#' class='table-link danger'> \
                                            <span class='fa-stack'> \
                                                <i class='fa fa-square fa-stack-2x'></i> \
                                                <i class='fa fa-trash-o fa-stack-1x fa-inverse'></i> \
                                            </span> \
                                        </a> \
                                    </td> \
                                </tr> \
                                ";
            $("#user-container").append(html);
        }

    }
</script>