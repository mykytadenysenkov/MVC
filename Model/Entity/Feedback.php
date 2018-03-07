<?php

namespace Model\Entity;

class Feedback {
    private $id;
    private $email;
    private $message;
    private $created;

    /**
     * Feedback constructor.
     * @param $email
     * @param $message
     */
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
        $this->created = new \DateTime();
    }

    public function getMySqlFormat()
    {
        return $this->created->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}