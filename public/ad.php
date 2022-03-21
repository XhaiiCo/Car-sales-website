<?php require_once "./template/header.php" ?>
<script>
    let searchParams = new URLSearchParams(window.location.search);
    const id = searchParams.get('id');
    if (!searchParams.has('id')) {
        window.location = "index.php";
    }
</script>

<script>
    console.log(id);
</script>
<?php require_once "./template/footer.php" ?>