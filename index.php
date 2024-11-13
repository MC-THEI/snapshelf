<?php

session_start();
require_once "init.php";

$router = $container->build("Router");

$request = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'];

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($request) {

    case "/Snapshelf/":
        $router->add("IndexController", "home");
        break;

    case "/Snapshelf/dashboard":
        $router->add("DashboardController", "dashboard");
        break;

    case "/Snapshelf/users":
        $router->add("UserController", "allUsers");
        break;

    case "/Snapshelf/user":
        $router->add("UserController", "userProfile");
        break;

    case "/Snapshelf/register":
        $router->add("RegisterController", "register");
        break;

    case "/Snapshelf/login":
        $router->add("LoginController", "loginPage");
        break;

    case "/Snapshelf/logout":
        $router->add("LogoutController", "logout");
        break;


    case "/Snapshelf/albums":
        $router->add("PhotoAlbumsController", "photoAlbumsPage");
        break;

    case "/Snapshelf/album":
        $router->add("PhotoAlbumController", "photoAlbumPage");
        break;

    case "/Snapshelf/album-settings":
        $router->add("PhotoAlbumsController", "photoAlbumSettingsPage");
        break;
    //ajax
    case "/Snapshelf/albums-newAlbum":
        $router->add("PhotoAlbumsController", "ajax_createNewAlbum");
        $router->add("PhotoAlbumsController", "ajax_addNewAlbumOnPage");
        break;

    case "/Snapshelf/albums-updateAlbum":
        $router->add("PhotoAlbumsController", "ajax_updateAlbum");
        $router->add("PhotoAlbumsController", "ajax_photoAlbumSettingsPage");
        break;

    default:
        $router->add("ErrorController", "errorPage");
        break;
}