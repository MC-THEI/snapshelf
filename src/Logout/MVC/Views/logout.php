<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>

<div class="mb-3 mt-5 container clearfix">
    <div class="">
        <a class="float-end" href="/Snapshelf/login"><button class="btn btn-secondary" name="login">Login</button></a>
    </div>
</div>
<div class="container">
    <h3 class="alert alert-warning text-center">Du hast dich erfolgreich ausgeloggt, <?php echo $_SESSION["userName"] ?>!</h3>
</div>

<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>