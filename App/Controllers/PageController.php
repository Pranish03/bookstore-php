<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function home()
    {
        $this->view('home.index');
    }

    public function not_found()
    {
        $this->view('errors.404');
    }
}
