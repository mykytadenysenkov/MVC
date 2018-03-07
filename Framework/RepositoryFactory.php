<?php

namespace Framework;

class RepositoryFactory
{
    private $repositories = [];
    private $dbConnection;

    public function setDBConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    public function createRepository($entityName)
    {
        if(isset($this->repositories[$entityName])) {
            return $this->repositories[$entityName];
        }

        $repository = "\Model\Repository\\{$entityName}Repository";
        //TODO: check if file exists
        $repository = new $repository();
        $repository->setDBConnection($this->dbConnection);
        $this->repositories[$entityName] = $repository;
        return $repository;
    }
}
