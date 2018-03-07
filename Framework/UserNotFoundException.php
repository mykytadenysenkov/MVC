<?php

namespace Framework;


class UserNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct("User not found");
    }
}