<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>

<h1>Candidature</h1>
<div id="candidacies-container"></div>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>


<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./model/admin/model_candidacy.php",
            dataType: "JSON",
            success: function(datas) {
                console.log(datas);
                $("#candidacies-container").html();
            }
        });
    });
</script>