<?php
namespace Controller\API;

use Framework\Controller;
use Framework\Request;

class BookController extends Controller
{
    public function indexAction(Request $request)
    {
        header("Content-type: application/json");

        $repository = $this->container->get('repository_factory')->createRepository('Book');;
        $page = $request->get('page', 1);
        $books = $repository->findAll($page, $hydration = true);

        return json_encode($books);
    }

    public function showAction(Request $request)
    {
        header("Content-type: application/json");

        $id = $request->get('id');
        $repository = $this->container->get( 'repository_factory')->createRepository('Book');
        $book = $repository->find($id, $hydration = true);

        return json_encode($book);
    }
}