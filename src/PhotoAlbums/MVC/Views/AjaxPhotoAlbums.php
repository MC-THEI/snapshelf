<?php foreach ($albums as $album): ?>
    <div class="col">
        <div style="height: 400px;" class="card album-card">
            <img
                style="height: 230px; width: 100%; object-fit: cover;"
                src="<?php echo $album->albumCover ? '../../../../../Snapshelf/src/UploadFiles/' . $album->albumCover : '../../../../../Snapshelf/public/albumcover_default.jpg'; ?>"
                class="card-img-top"
                alt="Album Cover"
            >
            <div class="card-body snap-card">
                <h5 class="card-title"><?php echo html($album->albumName) ?></h5>
                <p class="card-text"><?php echo html($album->albumDescription) ?></p>
                <a href="/Snapshelf/album?albumid=<?php echo $album->albumId ?>" class="button">Zu dem Album</a>
                <a href="/Snapshelf/album-settings?albumid=<?php echo $album->albumId ?>" class="button">Einstellungen</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<form method="post" id="newAlbumForm">
    <input type="hidden" name="albumName" value="Neues Album">
    <input type="hidden" name="albumDescription" value="angelegt am:">
    <input type="hidden" name="userId" value="<?php  echo $_SESSION["userId"] ?>">
    <button style="height: 230px" type="submit" class="col w-100 btn btn-secondary" name="newAlbum" value="send">Neues Album</button>
</form>

<script src="../../../../src/PhotoAlbums/MVC/AjaxPhotoAlbums/AjaxNewAlbums.js"></script>