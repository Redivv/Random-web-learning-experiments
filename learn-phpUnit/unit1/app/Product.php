<?php

namespace App;

class Product{
    protected $name;
    protected $price;

    public function __construct(String $name, Int $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function name()
    {
        return $this->name;
    }

    public function price()
    {
        return $this->price;
    }
}