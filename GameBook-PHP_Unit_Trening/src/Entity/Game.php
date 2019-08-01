<?php

class Game
{
    protected $title;
    protected $imagePath;
    protected $rating;

    public function isRecommended(object $user)
    {
        $compatibility = $user->getGenreCompatibility($this->getGenreCode());
        return ($this->getAvarageScore() / 10 * $compatibility >= 3);     // normalnie zapisany warunek - zwraca true albo false
    }

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
        if ($this->imagePath === null) {
            return '/images/placeholder.jpg';
        }
        return $this->imagePath;
    }

    public function setImagePath( ?string $value)
    {
        $this->imagePath = $value;
    }

    public function getRatings()
    {
        return $this->rating;
    }

    public function setRatings(array $value)
    {
        $this->rating = $value;
    }

    public function getAvarageScore()
    {
        $ratings = $this->getRatings();
        $numRatings = count($ratings);

        if ($numRatings <= 0) {
            return null;
        }

        $total = 0;
        foreach ($ratings as $rating) {
            $score = $rating->getScore();
            if ($score === null) {
                $numRatings --;
                continue;
            }
            $total += $score;
        }
        return $total / $numRatings;
    }

    public function toArray()
    {
        $array = [
            'title' => $this->title,
            'imagePath' => $this->imagePath,
            'ratings' => [],
        ];
        foreach ($this->getRatings() as $rating) {
            $array['ratings'][] = $rating->toArray();
        }
        return $array;
    }
}
