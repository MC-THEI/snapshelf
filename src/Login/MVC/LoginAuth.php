<?php

namespace App\Login\MVC;
use App\SecurityLogin\SecurityLoginDatabase;
use App\User\UserDataBase;

class LoginAuth {

    private UserDataBase $userDataBase;
    private SecurityLoginDatabase $securityLoginDatabase;

    public function __construct(UserDataBase $userDataBase, SecurityLoginDatabase $securityLoginDatabase) {
        $this->userDataBase = $userDataBase;
        $this->securityLoginDatabase = $securityLoginDatabase;
    }

    private function setIdentifier(): string {
        return bin2hex(time() . random_bytes(8));
    }

    private function setSecurityToken(): string {
        return bin2hex(time() . random_bytes(10));
    }



    public function buildStayin($email): bool
    {
        $identifier = $this->setIdentifier();
        $securityToken = $this->setSecurityToken();

        $user = $this->userDataBase->getUser("", $email);
        $this->securityLoginDatabase->newStayin($user->userId, $identifier, password_hash($securityToken, PASSWORD_DEFAULT));
        setcookie("identifier", $identifier, time() + 60 * 60 * 24 * 7);
        setcookie("securitytoken", $securityToken, time() + 60 * 60 * 24 * 7);

        if($user) {
            return true;
        }
        return false;
    }

    public function checkStayin(): void
    {
        if(isset($_COOKIE["identifier"]) && isset($_COOKIE["securitytoken"])) {
            $stayinData = $this->securityLoginDatabase->getStayinData($_COOKIE["identifier"]);
            if (!password_verify($_COOKIE["securitytoken"], $stayinData->securitytoken)) {
                die("Autologin ist fehlgeschlagen, bitte erneut einloggen");
            } else {
                session_regenerate_id(true);
                $newSecurityToken = $this->setSecurityToken();
                $this->securityLoginDatabase->updateSecurityToken(password_hash($newSecurityToken, PASSWORD_DEFAULT), $stayinData->userId);
                setcookie("securitytoken", $newSecurityToken, time() + 60 * 60 * 24 * 7);

                $_SESSION["userId"] = $stayinData->userId;
                $userData = $this->userDataBase->getUser($stayinData->userId, "");
                $_SESSION["userName"] = $userData->userName;
                $_SESSION["login"] = true;
            }
        }
    }

    public function checkLogin($email, $password): bool
    {
        $user = $this->userDataBase->getUser("", $email);
        if($user) {
            if(password_verify($password, $user->password)) {
                $user = $this->userDataBase->getUser("", $email);
                session_regenerate_id(true);
                $_SESSION["userName"] = $user->userName;
                $_SESSION["userId"] = $user->userId;
                $_SESSION["login"] = true;
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}