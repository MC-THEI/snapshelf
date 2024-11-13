<?php

namespace App\SecurityLogin;
use App\App\AbstractMVC\AbstractDataBase;
use App\SecurityLogin\MVC\SecurityLoginModel;
use PDO;

class SecurityLoginDatabase extends AbstractDataBase {

    function getTable()     {
        return 'securitytokens';
    }

    function getModel()     {
        return SecurityLoginModel::class;
    }

    public function newStayin($userId, $identifier, $securitytoken) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("INSERT INTO $table (userId, identifier, securitytoken) VALUES (:userId, :identifier, :securitytoken)");

            return $stmt->execute([
                ':userId' => $userId,
                ':identifier' => $identifier,
                ':securitytoken' => $securitytoken,
            ]);
        }
    }

    public function getStayinData($identifier) {
        $table = $this->getTable();
        $model = $this->getModel();
        if (!empty($this->pdo)) {
            $user = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE identifier = :identifier');
            $user->execute(['identifier' => $identifier]);
            $user->setFetchMode(PDO::FETCH_CLASS, $model);
            return $user->fetch();
        }
        return null;
    }

    public function updateSecurityToken($securitytoken, $userId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("UPDATE $table SET securitytoken = :securitytoken WHERE userId = :userId");
            return $stmt->execute([':securitytoken' => $securitytoken, ':userId' => $userId]);
        }
        return false;
    }

    public function deleteStayinData($userId) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE userId = :userId");
            return $stmt->execute([':userId' => $userId]);
        }
        return false;
    }
}