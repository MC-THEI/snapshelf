<?php

namespace App\PhotoAlbums\MVC;
use App\App\AbstractMVC\AbstractController;
use App\PhotoAlbum\PhotoAlbumDatabase;
use App\PhotoAlbums\PhotoAlbumsDatabase;

class PhotoAlbumsController extends AbstractController {

    private PhotoAlbumsDatabase $photoAlbumsDatabase;
    private PhotoAlbumDatabase $photoAlbumDatabase;
    public function __construct(PhotoAlbumsDatabase $photoAlbumsDatabase, PhotoAlbumDatabase $photoAlbumDatabase) {
        $this->photoAlbumsDatabase = $photoAlbumsDatabase;
        $this->photoAlbumDatabase = $photoAlbumDatabase;
    }

    public function photoAlbumsPage(): void {
        $albums = $this->photoAlbumsDatabase->getAlbums($_SESSION["userId"]);
        $this->pageload("PhotoAlbums", "photoAlbums", ["albums" => $albums]);
    }

    public function photoAlbumSettingsPage(): void {
        $userId = $_SESSION["userId"];
        $albumId = $_GET["albumid"];
        $album = $this->photoAlbumsDatabase->getAlbum($albumId);
        $successMsgCover = null;
        $successMsgPhotos = null;

        $errorMsgCover = null;
        $errorMsgPhotos = null;

        $successMsgDelete = null;

        /* Upload ALbumcover*/
        if(isset($_POST['albumCover-settings']) && isset($_FILES['albumcover'])) {
            $upload_dir = __DIR__ . "/../../../../Snapshelf/src/UploadFiles";
            $uploadFilename = basename($_FILES["albumcover"]["name"]);
            $newFilename = "$userId-$albumId-" . time() . ".png";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if(move_uploaded_file($_FILES["albumcover"]["tmp_name"], $upload_dir . "/" . $newFilename)) {
                $successMsgCover = "Datei erfolgreich hochgeladen";
                $this->photoAlbumsDatabase->updateAlbumCover($albumId, $newFilename);
            } else {
                $errorMsgCover = "Datei konnte nicht hochgeladen werden";
            }
        }

        /* Upload Album Photouploads*/
        if (isset($_POST['photoupload-settings']) && isset($_FILES['photoupload'])) {
            $upload_dir = __DIR__ . "/../../../../Snapshelf/src/UploadFiles/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $newFilename = "$albumId-$userId-" . date("dmY") . ".png";

            if (is_array($_FILES['photoupload']['name'])) {
                $files = $_FILES['photoupload'];

                for ($i = 0; $i < count($files['name']); $i++) {
                    $tmpName = $files['tmp_name'][$i];
                    $originalName = $files['name'][$i];
                    $newFilename = "$userId-$albumId-" . time() . uniqid() . ".png";
                    $targetPath = $upload_dir . $newFilename;

                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $this->photoAlbumsDatabase->storePhotos($albumId, $newFilename, $userId);
                        $successMsgPhotos = "Datei(en) erfolgreich hochgeladen" . $newFilename;
                    } else {
                        $errorMsgPhotos = "Datei(en) konnte nicht hochgeladen werden" . $newFilename;
                    }
                }
            } else {
                $file = $_FILES['photoupload'];
                $tmpName = $file['tmp_name'];
                $originalName = $file['name'];
                $targetPath = $upload_dir . $newFilename;
                $newFilename = "$userId-$albumId-" . time() . uniqid() . ".png";

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $this->photoAlbumsDatabase->storePhotos($albumId, $newFilename, $userId);
                    $successMsgPhotos = "Datei(en) erfolgreich hochgeladen" . $newFilename;
                } else {
                    $errorMsgPhotos = "Datei(en) konnte nicht hochgeladen werden" . $newFilename;
                }
            }
        }

        if(isset($_POST["deleteAlbumBtn"])) {
            $upload_dir = __DIR__ . "/../../../../Snapshelf/src/UploadFiles/";

            $photos = $this->photoAlbumDatabase->getPhotos($albumId);

            if ($photos) {
                foreach ($photos as $photo) {
                    $filePath = $upload_dir . $photo['photoName'];
                    $photoId = $photo['photoId'];

                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            $this->photoAlbumDatabase->deleteAlbumPhoto($photoId);
                            $successMsgDelete = "Foto erfolgreich gelöscht: " . $photo['filename'];
                        } else {
                            $errorMsgDelete = "Fehler beim Löschen des Fotos: " . $photo['filename'];
                        }
                    } else {
                        $errorMsg = "Foto existiert nicht: " . $photo['filename'];
                    }
                }

            }
            $this->photoAlbumsDatabase->deleteAlbum($albumId);
            header("Location: /Snapshelf/albums");
        }

        $this->pageload("PhotoAlbums", "photoAlbumSettings", [
            "album" => $album,
            "successMsgCover" => $successMsgCover,
            "successMsgPhotos" => $successMsgPhotos,
            "errorMsgCover" => $errorMsgCover,
            "errorMsgPhotos" => $errorMsgPhotos
        ]);
    }

    /* Ajax */
    public function ajax_createNewAlbum() {
        $albumName = html($_POST["albumName"]);
        $albumDescription = html($_POST["albumDescription"])  . " " . date("d.m.Y H.i") . " Uhr";
        $userId = $_POST["userId"];
        $this->photoAlbumsDatabase->addAlbum($albumName, $albumDescription, $userId);
    }

    public function ajax_addNewAlbumOnPage() {
        $albums = $this->photoAlbumsDatabase->getAlbums($_SESSION["userId"]);
        $this->pageload("PhotoAlbums", "ajaxPhotoAlbums", ["albums" => $albums]);
    }

    public function ajax_updateAlbum() {
        $albumId = $_POST["albumId"];
        $albumName = $_POST["albumName"];
        $albumDescription = $_POST["albumDescription"];
        $this->photoAlbumsDatabase->updateAlbum($albumId, $albumName, $albumDescription);
    }

    public function ajax_photoAlbumSettingsPage() {
        $album = $this->photoAlbumsDatabase->getAlbum($_POST["albumId"]);
        $this->pageload("PhotoAlbums", "AjaxAlbumSettingsForm", [
            "album" => $album,
            "success" => "Album erfolgreich geändert!"
        ]);
    }
}