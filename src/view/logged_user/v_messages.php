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
                    <div class="list-group no-margin list-message">
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">Jeck Joko <small>Yesterday at 15:45</small></h4>
                            <a href="annonce-4" class="list-group-item-text">
                                <strong>Mercedes AMG G63</strong>
                            </a>
                        </div>
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">Toni Miring <small>Sunday at 12:33</small></h4>
                            <a href="annonce-4" class="list-group-item-text">
                                <strong>Mercedes AMG G63</strong>
                            </a>
                        </div>
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">Bella Negoro <small>Sunday at 12:33</small></h4>
                            <a href="annonce-4" class="list-group-item-text">
                                <strong>Mercedes AMG G63</strong>
                            </a>
                        </div>
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">Daddy Botak <small>Sunday at 12:33</small></h4>
                            <a href="annonce-4" class="list-group-item-text">
                                <strong>Mercedes AMG G63</strong>
                            </a>
                        </div>
                    </div><!-- /.list-group -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.message-sideleft -->
        <div class="col-md-8 message-sideright">
            <div class="header">
                <input id="btn-new-message" type="button" class="btn btn-primary" value="Nouveau message"></input>
                <form id="foo">
                    <input class="form-control mb-2" type=" text" placeholder="Objet...">
                    <textarea class="form-control mb-2" placeholder="Réponse..."></textarea>
                    <input class="btn btn-primary" type="submit" value="Envoyer">
                </form>

            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">Rebecca Cabean <small>(Sales Manager)</small></h4>
                            <small>Thursday 5th July 2014</small>
                        </div>
                    </div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <p class="lead">
                        RE : Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </p>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <br>
                    <p>
                        Thanks! <br>
                        Rebecca.
                    </p>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
            <div class="panel">
                <div class="panel-heading">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">Sarah Tingting</h4>
                            <small>Thursday 5th July 2014</small>
                        </div>
                    </div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <p class="lead">
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </p>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.message-sideright -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#foo").hide();
        $("#btn-new-message").click(function() {
            $(this).hide();
            $("#foo").show();
        });

    });
</script>
<style>
    /* ========================================================================
 * MESSAGES
 * ======================================================================== */
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