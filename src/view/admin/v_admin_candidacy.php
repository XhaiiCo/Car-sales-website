<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>

<h1>Candidature</h1>
<div class="row">
    <div id="candidacies-container" class="col-lg-2">

    </div>

    <div id="candidacy-container" class="col">
    </div>
</div>

<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>

<script>
    $(document).ready(function() {
        acutListCandidacies();
    });

    function acutListCandidacies() {
        $.ajax({
            type: "POST",
            url: "./model/admin/model_candidacies.php",
            dataType: "JSON",
            success: function(datas) {
                displayListCandidacies(datas);
            }
        });
    }

    function displayListCandidacies(datas) {
        $("#candidacies-container").html("");
        for (data of datas) {
            divContainer = document.createElement("div");
            $(divContainer).attr("class", "candidacy")
            $(divContainer).html(data.username + "  " + data.date_send);
            $(divContainer).attr("id", data.id_candidacy)
            $("#candidacies-container").append(divContainer);
        }

        $(".candidacy").click(function() {
            $(".candidacy").removeClass("active");
            $(this).addClass("active");

            $.ajax({
                type: "POST",
                url: "./model/admin/model_candidacy.php",
                dataType: "JSON",
                data: {
                    id: this.id
                },
                success: function(datas) {
                    displayCandidacy(datas);
                }
            });
        })
    }

    function displayCandidacy(datas) {
        data = datas[0];

        divContainer = document.createElement("div");

        pMessage = document.createElement("p");
        $(pMessage).html(data.user_message);
        $(divContainer).append(pMessage);


        divBtnContainer = document.createElement("div");
        $(divContainer).append(divBtnContainer);

        btnDecline = document.createElement("button");
        $(btnDecline).html("Refuser");
        $(btnDecline).addClass("btn btn-danger");
        $(divBtnContainer).append(btnDecline);

        btnAccept = document.createElement("button");
        $(btnAccept).html("Accepter");
        $(btnAccept).addClass("btn btn-success mx-4");
        $(divBtnContainer).append(btnAccept);

        $("#candidacy-container").html(divContainer);


        $(btnDecline).click(function() {
            candidacyFeedback(data.user_from, 0);
        })

        $(btnAccept).click(function() {
            candidacyFeedback(data.user_from, 1);
        })
    }

    function candidacyFeedback(user, isSeller) {
        console.log(user);
        $.ajax({
            type: "POST",
            url: "./model/admin/model_candidacy_feedback.php",
            data: {
                user: user,
                isSeller: isSeller
            },
            success: function() {
                acutListCandidacies();
                $("#candidacy-container").html("");
            }
        });
    }
</script>

<style>
    #candidacies-container {
        height: 100vh;
        border-right: 1px solid black;

    }

    #candidacies-container>div {
        cursor: pointer;
        height: 50px;
        line-height: 50px;
        border-bottom: 1px solid grey;
    }

    #candidacies-container>div:hover {
        background-color: #f1eceb;
    }

    .active {
        background-color: #f1eceb;
    }

    @media only screen and (max-width: 992px) {
        #candidacies-container {
            height: 200px;
            overflow-y: auto;
            border-bottom: 1px solid black;
            border-right: none;

        }

        #candidacy-container {
            margin-top: 10px;
        }
    }
</style>