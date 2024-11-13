<?php

namespace App\PhotoAlbum;
use App\App\AbstractMVC\AbstractDatabase;
use App\PhotoAlbum\MVC\PhotoAlbumModel;
use App\PhotoAlbums\MVC\PhotoAlbumsModel;
use PDO;

class PhotoAlbumDatabase extends AbstractDatabase {

    function getTable() {
        return 'photolinks';
    }

    function getModel($model) {
        if ($model == "albums") {
            return PhotoAlbumsModel::class;
        } else {
            return PhotoAlbumModel::class;
        }
    }

    function getPhotos($albumId) {
        $table = $this->getTable();
        $model = $this->getModel("photos");
        if (!empty($this->pdo)) {
            $photos = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE albumId = :albumId');
            $photos->execute([':albumId' => $albumId]);
            $photos->setFetchMode(PDO::FETCH_CLASS, $model);
            return $photos->fetchAll();
        }
        return null;
    }

    public function getAlbum($albumId) {
        $model = $this->getModel("albums");
        if (!empty($this->pdo)) {
            $sql = 'SELECT * FROM photoalbums WHERE albumId = :albumId';
            $albums = $this->pdo->prepare($sql);
            $albums->execute([':albumId' => $albumId]);
            $albums->setFetchMode(PDO::FETCH_CLASS, $model);
            return $albums->fetch();
        }
        return null;
    }


    public function deleteAlbumPhoto($photoId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE photoId = :photoId");
            return $stmt->execute([
                ':photoId' => $photoId,
            ]);
        }
    }

    public function deleteAlbumPhotos($albumId, $userId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE albumId = :albumId AND userId = :userId");
            return $stmt->execute([
                ':albumId' => $albumId,
                ':userId' => $userId
            ]);
        }
    }
}