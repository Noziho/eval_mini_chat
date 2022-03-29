<?php

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * print 404 error page
     * @param $askPage
     */
    public function error404 ($askPage) {
        $this->render('error/404');
    }

}