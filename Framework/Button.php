<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.02.2018
 * Time: 12:11
 */

namespace Framework;


class Button
{
    public $page;
    public $text;
    public $isActive;

    public function __construct($page, $isActive = true, $text = null)
    {
        $this->page = $page;
        $this->text = is_null($text) ? $page : $text;
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }


}