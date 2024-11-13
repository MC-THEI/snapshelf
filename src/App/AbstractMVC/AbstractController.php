<?php

namespace App\App\AbstractMVC;

abstract class AbstractController {

    public function pageload($dir, $view, $var) {

        extract($var);
        require_once __DIR__ . "/../../$dir/MVC/Views/$view.php";
    }

}