<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>

<h1>Gestion des véhicules présent sur le site</h1>
<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>