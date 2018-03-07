<?php

namespace Controller\Admin;

use Framework\Controller;
use Framework\Request;
use Framework\Session;

class BookController extends Controller {
    public function indexAction(Request $request) {
        if (!Session::has('user')) {
            throw new AccessDeniedException();
        }

        return $this->render('index.html.twig');
    }

    public function showAction(Request $request) {
        if (!Session::has('user')) {
            throw new AccessDeniedException();
        }

        return $this->render('show.html.twig');
    }

    public function editAction(Request $request) {
        if (!Session::has('user')) {
            throw new AccessDeniedException();
        }

        return $this->render('show.html.twig');
    }

    public function createAction(Request $request) {
        if (!Session::has('user')) {
            throw new AccessDeniedException();
        }

        return $this->render('show.html.twig');
    }
}