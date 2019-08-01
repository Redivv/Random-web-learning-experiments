<?php

require __DIR__ . "/../Entity/Game.php";
require __DIR__ . "/../Entity/Rating.php";

class GameRepository
{
    protected $pdo;

    public function __construct(Type $var = null) {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=game_test',
            'root',
            '^Qj5RC3M3#'
        );
    }

    public function findById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM game WHERE id = ?');
        $statement->execute([$id]);
        $game = $statement->fetchObject('Game');        // przypisuje pobrane wartości do pasujący w obiekcie (te które może)
        return $game; 
    }

    public function saveGameRating(int $gameId, int $userId, float $score)
    {
        $statement = $this->pdo->prepare('REPLACE INTO rating (game_id, user_id, score) VALUES (?,?,?)');
        return $statement->execute([$gameId,$userId,$score]);
    }

    public function findByUserId(int $id)
    {
        $games = array();
        for ($i=1; $i <= 6; $i++) { 
            $game = new Game();
            $game->setTitle("Game " . $i);
            $game->setImagePath('/images/game.jpg');
            $rating = new Rating(4.5);
            $game->setRatings([$rating]);
            $games[] = $game;
        }
        return $games;
    }
}
