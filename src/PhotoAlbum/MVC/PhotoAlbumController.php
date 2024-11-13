<?php

namespace App\PhotoAlbum\MVC;
use App\App\AbstractMVC\AbstractController;
use App\PhotoAlbum\PhotoAlbumDatabase;
use App\PhotoAlbums\PhotoAlbumsDatabase;

class PhotoAlbumController extends AbstractController {

    private $photoAlbumDatabase;
    private $photoAlbumsDatabase;

    public function __construct(PhotoAlbumDatabase $photoAlbumDatabase, PhotoAlbumsDatabase $photoAlbumsDatabase) {
        $this->photoAlbumDatabase = $photoAlbumDatabase;
        $this->photoAlbumsDatabase = $photoAlbumsDatabase;
    }

    public function photoAlbumPage(): void {
        $albumId = $_GET["albumid"];
        $album = $this->photoAlbumsDatabase->getAlbum($albumId);
        $photos = $this->photoAlbumDatabase->getPhotos($albumId);
        $this->pageload("PhotoAlbum", "photoAlbum", [
            "photos" => $photos,
            "album" => $album
        ]);
    }
}