<?php

namespace App\PhotoAlbums;
use App\App\AbstractMVC\AbstractDataBase;
use App\PhotoAlbums\MVC\PhotoAlbumsModel;
use PDO;

class PhotoAlbumsDatabase extends AbstractDatabase {

    function getTable(): string {
        return 'photoalbums';
    }

    function getModel(): string {
        return PhotoAlbumsModel::class;
    }

    public function getAlbums($userId) {
        $table = $this->getTable();
        $model = $this->getModel();
        if (!empty($this->pdo)) {
            $albums = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE userId = :userId');
            $albums->execute([':userId' => $userId]);
            $albums->setFetchMode(PDO::FETCH_CLASS, $model);
            return $albums->fetchAll();
        }
    }

    public function getAlbum($albumId) {
        $table = $this->getTable();
        $model = $this->getModel();
        if (!empty($this->pdo)) {
            $album = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE albumId = :albumId');
            $album->execute([':albumId' => $albumId]);
            $album->setFetchMode(PDO::FETCH_CLASS, $model);
            return $album->fetch();
        }
    }

    public function addAlbum($albumName, $albumDescription, $userId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("INSERT INTO $table (albumName, albumDescription, userId) VALUES (:albumName, :albumDescription, :userId)");

            return $stmt->execute([
                ':albumName' => $albumName,
                ':albumDescription' => $albumDescription,
                ':userId' => $userId
            ]);
        }
    }

    public function updateAlbum($albumId, $albumName, $albumDescription) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("UPDATE $table SET albumName = :albumName, albumDescription = :albumDescription WHERE albumId = :albumId");
            return $stmt->execute([
                ':albumName' => $albumName,
                ':albumDescription' => $albumDescription,
                ':albumId' => $albumId
            ]);
        }
    }

    public function updateAlbumCover($albumId, $albumCover) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("UPDATE $table SET albumCover = :albumCover WHERE albumId = :albumId");
            return $stmt->execute([
                ':albumCover' => $albumCover,
                ':albumId' => $albumId
            ]);
        }
    }

    public function deleteAlbum($albumId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE albumId = :albumId");
            return $stmt->execute([
                ':albumId' => $albumId
            ]);
        }
    }

    public function storePhotos( $albumId, $photoName, $userId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("INSERT INTO photolinks (albumId, photoName, userId) VALUES (:albumId, :photoName, :userId)");
            return $stmt->execute([
                ':albumId' => $albumId,
                ':photoName' => $photoName,
                ':userId' => $userId,
            ]);
        }
    }
}