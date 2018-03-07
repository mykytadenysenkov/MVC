<?php

namespace Controller;


use Framework\Controller;
use Framework\Request;
use Framework\Session;

class CartController extends Controller
{
    public function indexAction(Request $request)
    {
        $currentCart = Session::get('cart', []);
        $books = $this->container->get('repository_factory')->createRepository("Book")->findByIds($currentCart);

        return $this->render('index.html.twig', ['books' => $books]);
    }

    public function addToCartAction(Request $request)
    {
        $currentCart = Session::get('cart', []);
        $currentCart[] = $request->get('id');
        Session::set('cart', array_unique($currentCart));

        $this->container->get('router')->redirect('books_list_default');
    }

    public function removeFromCartAction()
    {

    }

    public function clearCartAction()
    {

    }
}