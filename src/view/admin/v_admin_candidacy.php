<?php
if (!isAdmin()) {
    exit();
}
?>

<?php require_once "../src/view/admin/elements/v_admin_sidebar.php"; ?>

<?php require_once "../src/view/admin/elements/v_admin_ender.php"; ?>