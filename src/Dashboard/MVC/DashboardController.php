<?php

namespace App\Dashboard\MVC;
use App\App\AbstractMVC\AbstractController;

class DashboardController extends AbstractController {

    public function dashboard() {

        if($_SESSION["login"]) {
            return $this->pageload('Dashboard', 'dashboard', []);
        } else {
            header("Location: /Snapshelf/login");
        }
    }
}