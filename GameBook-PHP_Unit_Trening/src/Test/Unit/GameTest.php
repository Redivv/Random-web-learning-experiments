<?php   

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../Entity/Game.php';

class GameTest extends TestCase
{
    public function testImage_WithNull_ReturnPlaceholder()
    {
        $game = new Game();
        $game->setImagePath(null);
        $this->assertEquals('/images/placeholder.jpg', $game->getImagePath());
    }
}
