<?php

namespace App\Controllers;

use Rena\Lib\Middleware\RenaController;

class IndexController extends RenaController
{
    public function index() {
        return $this->render("placeholder.html", array());
    }
    
    public function api() {
        return $this->json(array("ermergerd" => true));
    }
}