<?php
if (!isConnected()) {
    exit();
}
?>
<div class="container-fluid mt-3">
    <div class="row message-wrapper">
        <div class="col-md-4 message-sideleft">
            <div class="panel">
                <div class="panel-heading">
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding">
                    <div id="list-message" class="list-group no-margin list-message">

                    </div><!-- /.list-group -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.message-sideleft -->
        <div class="col-md-8 message-sideright">
            <div id="messages">

            </div>
        </div><!-- /.message-sideright -->
    </div>
</div>

<script>
    $(document).ready(function() {
        setListMessage();
    });

    function setListMessage() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "./model/logged_user/model_list_message.php",
            success: function(datas) {
                putListMessage(datas);
            }
        });
    }

    function putListMessage(datas) {
        const list_message = $("#list-message");

        $(list_message).html("");
        for (data of datas) {
            var html = "";

            html += "<div id_conversation='" + data.id_conversation + "'class='list-group-item'>"
            html += "<h4 class='list-group-item-heading'>" + data.username + "<small> (" + data.user_mail + ")</small></h4>"
            html += "<a href='annonce-" + data.id_sale + "'class='list-group-item-text'>"
            html += "<strong>" + data.brand_name + " " + data.model_name + "</strong>"
            html += "</a>"
            html += "</div>"

            $(list_message).append(html);
        }

        $(".list-group-item").click(function() {
            const id_conversation = $(this).attr("id_conversation");
            setMessage(id_conversation);
        })
    }

    function setMessage(id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                id_conversation: id
            },
            url: "./model/logged_user/model_messages.php",
            success: function(datas) {
                putMessage(datas);
            }
        });
    }

    function putMessage(datas) {
        const message = $("#messages");

        $(message).html(
            "<div class='header'> \
                <input id='btn-new-message' type='button' class='btn btn-primary' value='Nouveau message'></input> \
                <form id='foo'> \
                    <textarea class='form-control mb-2'id='reponse-message' placeholder='Réponse...'></textarea> \
                    <input class='btn btn-primary' type='submit' value='Envoyer'> \
                </form> \
            </div> \
        ");

        $("#foo").hide();
        $("#btn-new-message").click(function() {
            $(this).hide();
            $("#foo").show();
        });

        $("#foo").submit(function(e) {
            e.preventDefault();

            const id_conversation = datas[0].id_conversation;
            $.ajax({
                type: "post",
                data: {
                    message: $("#reponse-message").val(),
                    id: id_conversation
                },
                url: "./model/logged_user/model_send_message_byid.php",
                success: function() {
                    setMessage(id_conversation);
                }

            });
        })

        for (data of datas) {
            html = "";

            html += "<div class='panel'>"
            html += "<div class='panel-heading'>"
            html += "<div class='media'>"
            html += "<div class='media-body'>"
            html += "<h4 class='media-heading'>" + data.username + "</h4>"
            html += "<small>" + data.date_send + "</small>"
            html += "</div>"
            html += "</div>"
            html += "</div>"
            html += "<div class='panel-body'>"
            html += "<p class='lead'>"
            html += data.message
            html += "</p>"
            html += "</div>"
            html += "</div>"
            html += "<hr>"

            $(message).append(html);
        }

    }
</script>
<style>
    .message form {
        padding: 6px 15px;
        background-color: #FAFAFA;
        border-bottom: 1px solid #E6EBED;
    }

    .message form .has-icon .form-control-icon {
        position: absolute;
        z-index: 5;
        top: 0;
        right: 0;
        width: 34px;
        line-height: 33px;
        text-align: center;
        color: #777;
    }

    .message>a {
        position: relative;
    }

    .message .indicator {
        text-align: center;
    }

    .message .indicator .spinner {
        left: 26%;
        width: 200px;
        font-size: 13px;
        line-height: 17px;
        color: #999;
    }

    .message-wrapper {
        position: relative;
        padding: 0px;
        background-color: #ffffff;
        margin: 0px;
    }

    .message-wrapper .message-sideleft {
        vertical-align: top !important;
    }

    .message-wrapper .message-sideleft[class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }

    .message-wrapper .message-sideright {
        background-color: #f8f8f8;
    }

    .message-wrapper .message-sideright[class*="col-"] {
        padding: 30px;
    }

    .message-wrapper .message-sideright .panel {
        border-top: 1px dotted #DDD;
        padding-top: 20px;
    }

    .message-wrapper .message-sideright .panel:first-child {
        border-top: none;
        padding-top: 0px;
    }

    .message-wrapper .message-sideright .panel .panel-heading {
        border-bottom: none;
    }

    .message-wrapper .panel {
        background-color: transparent !important;
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }

    .message-wrapper .panel .panel-heading,
    .message-wrapper .panel .panel-body {
        background-color: transparent !important;
    }

    .message-wrapper .media .media-body {
        font-weight: 300;
    }

    .message-wrapper .media .media-heading {
        margin-bottom: 0px;
    }

    .message-wrapper .media small {
        color: #999999;
        font-weight: 400;
    }

    .list-message .list-group-item {
        cursor: pointer;
        padding: 15px;
        color: #999999 !important;
        border-right: 3px solid #8CC152 !important;
    }

    .list-message .list-group-item small {
        font-size: 12px;
    }

    .list-message .list-group-item .list-group-item-heading {
        color: #999999 !important;
    }

    .list-message .list-group-item .list-group-item-text {
        margin-bottom: 10px;
    }

    .list-message .list-group-item:last-child {
        -moz-border-radius: 0px;
        -webkit-border-radius: 0px;
        border-radius: 0px;
        border-bottom: 1px solid #DDD !important;
    }

    .avatar {
        width: 50px;
        height: 50px;
    }
</style>