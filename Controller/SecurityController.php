<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Framework\Session;
use Framework\UserNotFoundException;
use Model\Entity\User;
use Model\Form\LoginForm;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        error_reporting(E_ALL);
        $form = new LoginForm($request->post('email'), $request->post('password'));

        if ($request->isPost()) {
            if ($form->isValid()) {
                $user = $this->container->get('repository_factory')->createRepository('User')->findByEmail($form->email);
                try {
                    if (!$user) {
                        throw new UserNotFoundException();
                    }

                    $this->verify($form->password, $user);
                } catch (UserNotFoundException $e) {
                    Session::setFlash($e->getMessage());
                    $this->container->get('router')->redirect('sign_in');
                }

                Session::set('user', $user->getEmail());
                $this->container->get('router')->redirect('admin_homepage');
            }
            Session::setFlash('Invalid form');
        }
        $flash = Session::getFlash();
        return $this->render('login.html.twig', ['form' => $form, 'flash' => $flash]);
    }

    public function logoutAction()
    {
        Session::remove('user');
        $this->container->get('router')->redirect('homepage');
    }

    public function changePasswordAction()
    {

    }

    public function registerAction()
    {

    }

    public function activateAccountAction()
    {

    }

    private function verify($password, User $user) {
        $result = password_verify($password, $user->getPassword());
        if($result) {
            return true;
        }
        
        throw new UserNotFoundException();
    }
}