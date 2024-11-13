<?php

namespace App\Logout\MVC;
use App\App\AbstractMVC\AbstractController;
use App\SecurityLogin\SecurityLoginDatabase;

class LogoutController extends AbstractController {

    private SecurityLoginDatabase $securityLoginDatabase;
    public function __construct(SecurityLoginDatabase $securityLoginDatabase) {
        $this->securityLoginDatabase = $securityLoginDatabase;

    }
    public function logout() {
        unset($_SESSION["login"]);

        $this->securityLoginDatabase->deleteStayinData($_SESSION["userId"]);
        setcookie("identifier", "", time() - 3600);
        setcookie("securitytoken", "", time() - 3600);
        $this->pageload("Logout", "logout", []);
    }
}