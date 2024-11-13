<?php

namespace App\PhotoAlbums\MVC;
use App\App\AbstractMVC\AbstractModel;

class PhotoAlbumsModel extends AbstractModel {
    public $albumId;

    public $userId;

    public $albumName;

    public $albumDescription;

    public $albumCover;
}