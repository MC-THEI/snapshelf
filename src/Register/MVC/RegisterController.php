<?php

namespace App\Register\MVC;
use App\App\AbstractMVC\AbstractController;
use App\User\UserDataBase;

class RegisterController extends AbstractController {

    private UserDataBase $userDataBase;

    public function __construct(UserDataBase $userDataBase) {
        $this->userDataBase = $userDataBase;
    }
    public function register() {
        $errorMsg = null;
        $msg = null;
        $inputValues = [
            "firstName" => "",
            "lastName" => "",
            "userName" => "",
            "email" => "",
            "password" => "",
        ];

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if (!empty($_POST)) {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $errorMsg = "Ungültiger CSRF-Token";
            } else {
                $inputValues['firstName'] = htmlspecialchars(trim($_POST['firstName']));
                $inputValues['lastName'] = htmlspecialchars(trim($_POST['lastName']));
                $inputValues['userName'] = htmlspecialchars(trim($_POST['userName']));
                $inputValues['email'] = trim($_POST['email']);
                $inputValues['password'] = trim($_POST['password']);

                $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|de|net|org|info|edu)$/";

                if (empty($inputValues['firstName']) || empty($inputValues['lastName']) || empty($inputValues['userName']) || empty($inputValues['email']) || empty($password)) {
                    $errorMsg = "Bitte alle Felder ausfüllen";
                } elseif (!preg_match($emailRegex, $inputValues['email'])) {
                    $errorMsg = "Ungültige E-Mail-Adresse. Die E-Mail muss eine gültige Endung (z.B. .de, .com) haben.";
                } elseif (strlen($inputValues['password']) < 8) {
                    $errorMsg = "Das Passwort muss mindestens 8 Zeichen lang sein";
                } else {
                    $hashedPassword = password_hash($inputValues['password'], PASSWORD_DEFAULT);

                    $user = $this->userDataBase->getUser("", $inputValues['email']);
                    if (empty($user)) {
                        $this->userDataBase->storeUser($inputValues['firstName'], $inputValues['lastName'], $inputValues['userName'], $inputValues['email'], $hashedPassword);
                        $msg = "Registrierung erfolgreich";
                        $inputValues = [ "firstName" => "", "lastName" => "", "userName" => "", "email" => "" ];
                    } else {
                        $errorMsg = "E-Mail Adresse existiert bereits";
                    }
                }
            }
        }

        $this->pageload("Register", "register", [
            "errorMsg" => $errorMsg,
            "message" => $msg,
            "inputValues" => $inputValues,
            "csrf_token" => $_SESSION['csrf_token']
        ]);
    }






}