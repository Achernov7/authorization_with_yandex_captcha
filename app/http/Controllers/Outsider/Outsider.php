<?php

namespace App\http\Controllers\Outsider;

use rmvc\vc\Response\View\View;
use rmvc\vc\Controller\Controller;

class Outsider extends Controller
{
    public function index()
    {
        return View::view('outsider.index');
    }
}