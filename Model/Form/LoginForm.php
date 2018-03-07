<?php

namespace Model\Form;


class LoginForm
{
    public $email;
    public $password;

    /**
     * LoginForm constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function isValid()
    {
        return !empty($this->email) && !empty($this->password);
    }
}