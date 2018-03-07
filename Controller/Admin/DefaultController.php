<?php

namespace Controller\Admin;

use Framework\AccessDeniedException;
use Framework\Controller;
use Framework\Session;

class DefaultController extends Controller {
    public function indexAction() {
        if(!Session::has('user')) {
            throw new AccessDeniedException();
        }

        return $this->render('index.html.twig');
    }
}