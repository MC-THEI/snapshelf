<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>
<?php require_once __DIR__ . "/../../../Components/navbar.php"; ?>

<link rel="stylesheet" href="/Snapshelf/src/Dashboard/MVC/Views/dashboard.css">

<div class="container mt-5">
    <h1 class="mb-4">Dein Dashboard, <?php echo $_SESSION["userName"] ?></h1>
        <div class="row align-items-start">
            <div class="col">
                <div class="card pt-4 snap-card">
                    <img src="public/photos.png" class="card-img-top images mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text">Deine Fotoalben</h5>
                        <p class="card-text text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="/Snapshelf/albums" class="button">Zu den Alben</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card pt-4 snap-card">
                    <img src="public/profile.png" class="card-img-top images mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text">Dein Profil</h5>
                        <p class="card-text text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="/Snapshelf/profile" class="button">Zu deinem Profil</a>
                    </div>
                </div>    
            </div>
            <div class="col">
                <div class="card pt-4 snap-card">
                    <img src="public/settings.png" class="card-img-top images mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text">Einstellungen</h5>
                        <p class="card-text text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="/Snapshelf/settings" class="button">Zu den Einstellungen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . "/../../../Components/footer.php"; ?>
<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>

