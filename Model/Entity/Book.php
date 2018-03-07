<?php

namespace Model\Entity;

class Book {
    private $id;
    private $title;
    private $description;
    private $price;
    private $active;
    private $created;
    private $category;

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
    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getShortDescription()
    {
        return substr($this->description, 0, 100);
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = (bool)$active;
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

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }


    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
}