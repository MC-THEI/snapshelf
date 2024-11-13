<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>
<?php require_once __DIR__ . "/../../../Components/navbar.php"; ?>

<link rel="stylesheet" href="/Snapshelf/src/PhotoAlbums/MVC/Views/photoAlbums.css">

<div class="container mt-5 mb-5">
    <h1>Deine Fotoalben</h1>
</div>

<div class="container mb-2">
<!--    <button class="btn btn-danger newAlbumBtn"
            data-userid="<?php /*echo $_SESSION["userId"] */?>"
            data-albumname="Neues Album"
            data-albumdescription="angelegt am:">Neues Album
    </button>-->
</div>
<div class="container">
    <div id="relPhotoAlbums" class="row row-cols-1 row-cols-md-3 g-4">

        <?php require_once __DIR__ . "/AjaxPhotoAlbums.php"; ?>

    </div>
</div>

<script src="../../../../src/PhotoAlbums/MVC/AjaxPhotoAlbums/AjaxNewAlbumBtn.js"></script>
<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>
