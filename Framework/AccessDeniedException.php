<?php

namespace Framework;


use Throwable;

class AccessDeniedException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Access denied");
    }
}