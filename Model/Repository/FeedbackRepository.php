<?php

namespace Model\Repository;

use Model\Entity\Feedback;

class FeedbackRepository {
    private $dbConnection;

    public function setDBConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    public function save(Feedback $feedback) {
        $dbConnection = $this->dbConnection;

        $data = [
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage(),
            'created' => $feedback->getMySqlFormat(),
        ];

        $sql = "INSERT INTO feedback (`email`, `message`, `created`) VALUES (:email, :message, :created)";
        $sth = $dbConnection->prepare($sql);
        $sth->execute($data);
    }
}