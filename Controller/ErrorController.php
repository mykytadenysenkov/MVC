<?php

namespace Controller;


use Framework\Controller;
use Framework\Request;

class ErrorController extends Controller
{
    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function error404Action(Request $request) {
        $message = $this->exception->getMessage();
        return $this->render('error404.html.twig', ['message' => $message]);
    }

    public function errorAction(Request $request) {
        $message = $this->exception->getMessage();
        return $this->render('error.html.twig', ['message' => $message]);
    }
}