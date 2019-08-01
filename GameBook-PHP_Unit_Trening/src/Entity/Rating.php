<?php

class Rating  
{
    protected $game;
    protected $user;
    protected $score;

    public function __construct(?float $score, ?object $user=null, ?object $game=null) {
        $this->score = $score;
        $this->game = $game;
        $this->user = $user;
    }

    public function toArray()
    {
        return [
            'score' => $this->getScore(),
        ];
    }

    public function setGame(object $game) {
        $this->game = $game;
    }

    public function getGame() {
        return $this->game;
    }

    public function setUser(object $score) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }

    public function setScore(?float $score) {
        $this->score = $score;
    }

    public function getScore() {
        return $this->score;
    }
}
