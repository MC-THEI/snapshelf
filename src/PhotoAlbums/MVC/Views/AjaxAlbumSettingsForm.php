<div id="relPhotoAlbums">
    <a href="/Snapshelf/albums" class="btn btn-secondary mb-5">Zurück</a>
    <h2 class="mb-3">Album Einstellungen #<?php echo $album->albumName ?></h2>
    <form method="post" id="updateAlbumForm">
        <div class="mb-3">
            <label for="albumName" class="form-label">Albumname</label>
            <input type="text" class="form-control" id="albumName" name="albumName" value="<?php echo $album->albumName ?>">
        </div>
        <div class="mb-3">
            <label for="albumDescription" class="form-label">Albumbeschreibung</label>
            <textarea class="form-control" name="albumDescription" id="albumDescription"><?php echo $album->albumDescription ?></textarea>
            <input type="hidden" name="albumId" value="<?php echo $album->albumId ?>">
        </div>

        <?php if (isset($success)): ?>
            <p class="text-success"><?php echo $success ?></p>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">speichern</button>

    </form>
</div>

<script src="../../../../src/PhotoAlbums/MVC/AjaxPhotoAlbums/AjaxUpdateAlbum.js"></script>
