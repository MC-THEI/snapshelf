<?php

namespace App\App;
use App\connections\ConMySQL;
use App\Dashboard\MVC\DashboardController;
use App\Error\MVC\ErrorController;
use App\Home\IndexDatabase;
use App\Home\MVC\IndexController;
use App\Login\MVC\LoginAuth;
use App\Login\MVC\LoginController;
use App\Logout\MVC\LogoutController;
use App\PhotoAlbums\MVC\PhotoAlbumsController;
use App\PhotoAlbums\PhotoAlbumsDatabase;
use App\Register\MVC\RegisterController;
use App\SecurityLogin\SecurityLoginDatabase;
use App\User\MVC\UserController;
use App\User\UserDataBase;
use App\PhotoAlbum\PhotoAlbumDatabase;
use App\PhotoAlbum\MVC\PhotoAlbumController;

class Container {
    private $classInstances = [];
    private $builds = [];

    public function __construct() {
        $this->builds = [
            "DashboardController" => function() {
                return new DashboardController();
            },

            "PhotoAlbumsController" => function() {
                return new PhotoAlbumsController(
                    $this->build('PhotoAlbumsDatabase'),
                    $this->build('PhotoAlbumDatabase'));
            },

            "PhotoAlbumController" => function() {
                return new PhotoAlbumController(
                    $this->build('PhotoAlbumDatabase'),
                    $this->build('PhotoAlbumsDatabase'));
            },

            "LoginController" => function() {
                return new LoginController($this->build('LoginAuth'));
            },

            "LogoutController" => function() {
                return new LogoutController($this->build('SecurityLoginDatabase'));
            },

            "LoginAuth" => function() {
                return new LoginAuth(
                    $this->build('UserDataBase'),
                    $this->build('SecurityLoginDatabase'));
            },

            "RegisterController" => function() {
                return new RegisterController($this->build('UserDataBase'));
            },

            "IndexController" => function() {
                return new IndexController($this->build('IndexDatabase'));
            },

            "IndexDatabase" => function() {
                return new IndexDatabase($this->build('pdo'));
            },

            "ErrorController" => function() {
                return new ErrorController();
            },

            "Router" => function() {
                return new Router($this->build("Container"));
            },

            "Container" => function() {
                return new Container();
            },

            "UserController" => function() {
                return new UserController($this->build('UserDataBase'));
            },

            "UserDataBase" => function() {
                return new UserDataBase($this->build('pdo'));
            },

            "SecurityLoginDatabase" => function() {
                return new SecurityLoginDatabase($this->build('pdo'));
            },

            "PhotoAlbumsDatabase" => function() {
                return new PhotoAlbumsDatabase($this->build('pdo'));
            },

            "PhotoAlbumDatabase" => function() {
                return new PhotoAlbumDatabase($this->build('pdo'));
            },

            'pdo' => function() {
                $connection = new ConMySQL;
                return $connection->connectToDB1();
            }
        ];
    }

    public function build($object) {
        if (isset($this->builds[$object])) {
            if(!empty($this->classInstances[$object])) {
                return $this->classInstances[$object];
            }
            $this->classInstances[$object] = $this->builds[$object]();
            return $this->classInstances[$object];
        }
        return $this->classInstances[$object];
    }

}