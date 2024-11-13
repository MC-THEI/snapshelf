<?php

namespace App\User;

use App\User\MVC\UserModel;
use App\App\AbstractMVC\AbstractDataBase;
use PDO;

class UserDataBase extends AbstractDataBase {

    public function getTable(): string
    {
        return 'users';
    }

    public function getModel(): string
    {
        return UserModel::class;
    }

    public function getUsers() {
        $table = $this->getTable();
        $model = $this->getModel();
        if (!empty($this->pdo)) {
            $users = $this->pdo->prepare('SELECT * FROM ' . $table);
            $users->execute();
            $users->setFetchMode(PDO::FETCH_CLASS, $model);
            return $users->fetchAll();
        }
    }

    public function getUser($id, $email) {
        $table = $this->getTable();
        $model = $this->getModel();
        if (!empty($this->pdo)) {
            $user = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE userId = :userId OR email = :email');
            $user->execute(['userId' => $id, ':email' => $email]);
            $user->setFetchMode(PDO::FETCH_CLASS, $model);
            return $user->fetch();
        }
        return null;
    }


    public function storeUser($firstName, $lastName, $userName, $email, $password) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("INSERT INTO $table (firstName, lastName, userName, email, password) VALUES (:firstName, :lastName, :userName, :email, :password)");

            return $stmt->execute([
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':userName' => $userName,
                ':email' => $email,
                ':password' => $password
            ]);
        }
    }


    public function updateUser($id, $newUsername) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("UPDATE $table SET username = :username WHERE id = :id");
            return $stmt->execute([':username' => $newUsername, ':id' => $id]);
        }
        return false;
    }

    public function deleteUser($id) {
        $table = $this->getTable();
        if (!empty($this->pdo)) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        }
        return false;
    }

}