<?php

namespace App\App\AbstractMVC;
use App\User\MVC\UserModel;

abstract class AbstractDatabase {
    protected $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    abstract function getTable();

/*    abstract function getModel();*/

}