<?php

namespace App\Controllers;

use MartynBiz\Slim3Controller\Controller;

class IndexController extends Controller
{
    public function index() {
        return $this->render("placeholder.html", array());
    }
}