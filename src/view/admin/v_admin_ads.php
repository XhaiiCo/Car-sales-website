<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>
<h1>Annonces</h1>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>