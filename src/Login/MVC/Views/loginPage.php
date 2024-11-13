<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>

<link rel="stylesheet" href="/Snapshelf/src/Login/MVC/Views/loginPage.css">

<div class="outer-container">
    <form class="form-container" method="post">
        <h4 class="label mb-3">Log dich ein</h4>
        <div class="mb-3">
            <label for="email" class="label form-label">E-mail Adresse</label>
            <input type="email" class="inputFields form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="label form-label">Passwort</label>
            <input type="password" class="inputFields form-control" id="password" name="password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="stayin" name="stayin" value="checked">
            <label class="label form-check-label" for="stayin">Eingeloggt bleiben</label>
        </div>
        <button type="submit" name="submit" class="button" value="send">Log in</button>
        <p class="text-danger"> <?php echo $errorMsg; ?></p>
        <img class="logo" src="/Snapshelf/public/logo_slim.png" alt="logo">
    </form>
</div>

<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>
