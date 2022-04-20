<?php
if (!isConnected()) {
    exit();
}
?>
<div class="container-fluid">
    <h1>Message</h1>
    <div class="row">
        <div id="list-messages-container" class="col-lg-3">
            <div id="1" class="message row border-bottom">
                <div class="row">
                    <a href="annonce-4">Mercedes G 63</a>
                </div>
                <div class="row">
                    <span>david</span>
                </div>
                <div class="row">
                    <span>davidleclercq2002@gmail.com</span>
                </div>
            </div>

            <div id="2" class="message row border-bottom">
                <div class="row">
                    <a href="annonce-4">Mercedes G 63</a>
                </div>
                <div class="row">
                    <span>david</span>
                </div>
                <div class="row">
                    <span>davidleclercq2002@gmail.com</span>
                </div>
            </div>
        </div>

        <div id="message-container" class="col-lg-9">
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {


        $(".message").click(function() {
            $(".message").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>

<style>
    #list-messages-container {
        height: calc(100vh - 120px);
        border-right: 1px solid black;

    }

    #list-messages-container>div:hover {
        cursor: pointer;
        background-color: #f1eceb;
    }

    .active {
        background-color: #f1eceb;
    }

    @media only screen and (max-width: 992px) {
        #list-messages-container {
            height: 200px;
            overflow-y: auto;
            border-bottom: 1px solid black;
            border-right: none;

        }
    }
</style>