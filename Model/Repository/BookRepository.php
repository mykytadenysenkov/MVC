<?php

namespace Model\Repository;

use Model\Entity\Book;
use Model\Entity\Category;

class BookRepository {
    private $dbConnection;

    public function setDBConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    public static function save(Book $book) {
        //TODO: check ID: if found - update, else - insert new
    }

    public function find($id, $hydration = false)
    {
        $dbConnection = $this->dbConnection;

        $sth = $dbConnection->prepare("SELECT * FROM book WHERE id = :id");
        $sth->execute(['id' => $id]);
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        if($hydration) {
            return $data;
        }

        $book = (new Book())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setPrice($data['price'])
            ->setActive($data['active'])
            ->setCreated($data['created'])
            ->setCategory($data['category_id']);

        return $book;
    }

    public function findAll($page = 1, $hydration = false)
    {
        $dbConnection = $this->dbConnection;
        $books = [];

        $per_page = PER_PAGE;
        $offset = $per_page * ($page - 1);

        $sth = $dbConnection->query("SELECT book.*, category.name FROM book JOIN category ON category.id = book.category_id ORDER BY title LIMIT {$offset}, {$per_page}");
        if($hydration) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }

        while ($data = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $books[] = (new Book())
                ->setId($data['id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setPrice($data['price'])
                ->setActive($data['active'])
                ->setCreated($data['created'])
                ->setCategory(new Category($data['category_id'], $data['name']));
        }
        return $books;
    }

    public function findByIds(array $ids)
    {
        $multiplier = count($ids) === 0 ? 0 : count($ids) - 1;
        $placeholders = "?" . str_repeat(",?", $multiplier);
        $sth = $this->dbConnection->prepare("SELECT * FROM book WHERE id IN ({$placeholders})");
        $sth->execute($ids);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findActive()
    {

    }

    public function count()
    {
        $sth = $this->dbConnection->query("SELECT COUNT(*) as `count` FROM book");

        return (int)$sth->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}