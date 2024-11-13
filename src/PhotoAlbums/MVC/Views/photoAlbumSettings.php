<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>
<?php require_once __DIR__ . "/../../../Components/navbar.php"; ?>

<!--Name and description-->
<div class="container mt-5 mb-5 col-sm-12 col-md-6">
    <?php require_once __DIR__ . "/../../../PhotoAlbums/MVC/Views/AjaxAlbumSettingsForm.php" ?>
</div>

<!--cover-->
<div class="container mt-5 mb-5 col-sm-12 col-md-6">
    <form id="albumcover-form" method="post" enctype="multipart/form-data">
        <label for="albumcover" class="form-label">Albumcover</label>
        <input type="hidden" name="albumId" value="<?php echo html($album->albumId); ?>">
        <input class="form-control mb-3" id="albumcover" type="file" name="albumcover">

        <p class="text-success"><?php echo $successMsgCover ?></p>
        <p class="text-danger"><?php echo $errorMsgCover ?></p>
        <button class="btn btn-primary" type="submit" name="albumCover-settings">Speichern</button>
    </form>
</div>

<!--Photoupload-->
<div class="container mt-5 mb-5 col-sm-12 col-md-6">
    <form id="photoupload-form" method="post" enctype="multipart/form-data">
        <label for="photoupload" class="form-label">Photoupload</label>
        <input type="hidden" name="albumId" value="<?php echo html($album->albumId); ?>">
        <input class="form-control mb-3" id="photoupload" type="file" name="photoupload[]" multiple>

        <p class="text-success"><?php echo $successMsgPhotos ?></p>
        <p class="text-danger"><?php echo $errorMsgPhotos ?></p>
        <button class="btn btn-primary" type="submit" name="photoupload-settings">Speichern</button>
    </form>
</div>



<!--Delete-->
<div class="container mt-5 mb-5 col-sm-12 col-md-6">
    <form id="deleteAlbumForm" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; ">
        <label for="deleteAlbum" class="form-label">Album löschen</label>
        <input type="hidden" name="albumId" value="<?php echo html($album->albumId); ?>">
        <button class="btn btn-danger" style="width: 100px" type="submit" name="deleteAlbumBtn">Löschen</button>
    </form>
</div>



<script src="../../../../src/PhotoAlbums/MVC/AjaxPhotoAlbums/AjaxUpdateAlbum.js"></script>
<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>

