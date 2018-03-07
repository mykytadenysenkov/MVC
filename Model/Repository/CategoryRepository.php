<?php

namespace Model\Repository;


use Model\Entity\Category;

class CategoryRepository
{
    private $dbConnection;

    public function setDBConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    public function findAll()
    {
        $dbConnection = $this->dbConnection;
        $categories = [];

        $sth = $dbConnection->query("SELECT * FROM category ORDER BY id");
        while($data = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $categories[] = (new Category($data['id'], $data['name']));
        }
        return $categories;
    }
}