<?php

class Game
{
    protected $title;
    protected $imagePath;
    protected $rating;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $value)
    {
        $this->title = $value;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setImagePath($value)
    {
        $this->imagePath = $value;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating(float $value)
    {
        $this->rating = $value;
    }
}
