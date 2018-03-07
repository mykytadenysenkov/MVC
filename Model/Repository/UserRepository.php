<?php

namespace Model\Repository;

use Model\Entity\User;

class UserRepository {
    private $dbConnection;

    public function setDBConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    public function findByEmail($email) {
        $sth = $this->dbConnection->prepare("SELECT * FROM user WHERE email = :email AND active = 1 LIMIT 1");
        $sth->execute(compact('email'));
        $data = $sth->fetch(\PDO::FETCH_ASSOC);

        if(!$data) {
            return null;
        }

        return (new User())
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setRole($data['role']);
    }
}