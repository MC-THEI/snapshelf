<?php

namespace App\Login\MVC;
use App\App\AbstractMVC\AbstractController;

class LoginController extends AbstractController {

    private LoginAuth $loginAuth;

    public function __construct(LoginAuth $loginAuth) {
        $this->loginAuth = $loginAuth;
    }

    public function loginPage(): void {

        $login = null;
        $errorMsg = null;

        if(!empty($_POST)) {
            $email = trim($_POST["email"]);
            $password = $_POST["password"];

            if(!empty($_POST["stayin"])) {
                $this->loginAuth->buildStayin($email);
            }

            $login = $this->loginAuth->checkLogin($email, $password);

            if($login) {
                header("Location: /Snapshelf/dashboard");
            } else {
                $errorMsg = "Der Login ist fehlgeschlagen";
            }
        }

        if(!isset($_SESSION["login"])) {
            $this->loginAuth->checkStayin();
        }

        if(isset($_SESSION["login"])) {
            header("Location: /Snapshelf/dashboard");
        } else {
            $this->pageload("Login", "loginPage", ["errorMsg" => $errorMsg]);
        }
    }
}