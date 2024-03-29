<?php
declare(strict_types=1);

require __DIR__ . '/../src/Repository/GameRepository.php';

$repo = new GameRepository;
$games = $repo->findByUserId(1);

?>

<ul>
    <?php foreach($games as $game): ?>
    <li>
        <?php echo $game->getTitle(); ?><br>
        <?php echo $game->getAvarageScore(); ?><br>
        <img src="<?php echo $game->getImagePath(); ?>" alt="">
    </li>
    <?php endforeach ?>
</ul>