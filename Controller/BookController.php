<?php
namespace Controller;

use Framework\Controller;
use Framework\Pagination;
use Framework\Request;
use Framework\Session;

class BookController extends Controller
{
    public function indexAction(Request $request)
    {
        $repository = $this->container->get('repository_factory')->createRepository('Book');
        $books_count = $repository->count();
        $page = $request->get('page', 1);

        $pagination = new Pagination(array('itemsCount' => $books_count,  'itemsPerPage' => PER_PAGE, 'currentPage' => $page));

        return $this->render('index.html.twig', ['pagination' => $pagination, 'flash' => Session::getFlash(), 'page' => $page]);
    }

    public function showAction(Request $request)
    {
        $id = $request->get('id');

        $repository = $this->container->get('repository_factory')->createRepository('Book');
        $book = $repository->find($id);
        try {
            if (empty($book->getId())) {
                throw new \Exception("Book not found");
            }
        } catch (\Exception $e) {
            Session::setFlash($e->getMessage());
            $this->container->get('router')->redirect('books_list_default');
        }


        return $this->render('show.html.twig', ['book' => $book]);
    }
}