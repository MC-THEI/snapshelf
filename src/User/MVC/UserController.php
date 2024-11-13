<?php

namespace App\User\MVC;
use App\User\UserDataBase;
use App\App\AbstractMVC\AbstractController;

class UserController extends AbstractController {

    private UserDataBase $userDataBase;

    public function __construct(UserDataBase $userDataBase) {
        $this->userDataBase = $userDataBase;
    }

    public function allUsers(): void
    {
        $users = $this->userDataBase->getUsers();
        $data = [
            "users" => $users
        ];
        $this->pageload("User", "users", $data);
    }

    public function userProfile(): void
    {
        $userId = $_GET["user"];
        $user =  $this->userDataBase->getUser($userId, "");
        $birthYear = 1990;

        $data = [
            "user" => $user,
            "birthYear" => $birthYear
        ];

        $this->pageload("User", "user", $data);
    }



}