<?php   

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testImage_WithNull_ReturnPlaceholder()
    {
        $game = new Game();
        $game->setImagePath(null);
        $this->assertEquals('/images/placeholder.jpg', $game->getImagePath());
    }

    public function testImage_WithPath_ReturnPath()
    {
        $game = new Game();
        $game->setImagePath('/images/game.jpg');
        $this->assertEquals('/images/game.jpg', $game->getImagePath());
    }

    // public function testIsRecommended_With5_ReturnsTrue()        irrelevant Test
    // {
    //     $game = $this->getMockBuilder(Game::class)
    //                   ->setMethods(['getAvarageScore'])
    //                   ->getMock();
    //     $game->method('getAvarageScore')->willReturn(5);
    //     $this->assertTrue($game->isRecommended());
    // }

    public function testAvarageScore_WithoutRatings_ReturnsNull()
    {
        $game = new Game();
        $game->setRatings([]);
        $this->assertNull($game->getAvarageScore());
    }

    public function testAvarageScore_With6And8_Returns7()
    {
        $rating1 = $this->getMockBuilder('lack')
                        ->setMockClassName('Rating')
                        ->setMethods(['getScore'])
                        ->getMock();
        $rating1->method('getScore')->willReturn(6);
        
        $rating2 = $this->getMockBuilder('lack')
                        ->setMockClassName('Rating')
                        ->setMethods(['getScore'])
                        ->getMock();
        $rating2->method('getScore')->willReturn(8);

        $game = $this->getMockBuilder(Game::class)
                     ->setMethods(['getRatings'])
                     ->getMock();
        $game->method('getRatings')->willReturn([$rating1,$rating2]);

        $this->assertEquals(7, $game->getAvarageScore());
    }

    public function testAvarageScore_With0And5_Returns5()
    {
        $rating1 = $this->getMockBuilder('lack')
                        ->setMockClassName('Rating')
                        ->setMethods(['getScore'])
                        ->getMock();
        $rating1->method('getScore')->willReturn(null);
        
        $rating2 = $this->getMockBuilder('lack')
                        ->setMockClassName('Rating')
                        ->setMethods(['getScore'])
                        ->getMock();
        $rating2->method('getScore')->willReturn(5);

        $game = $this->getMockBuilder(Game::class)
                     ->setMethods(['getRatings'])
                     ->getMock();
        $game->method('getRatings')->willReturn([$rating1,$rating2]);

        $this->assertEquals(5, $game->getAvarageScore());
    }

    public function testIsRecommended_WithCompatibility2AndScore10_ReturnsFalse()
    {
        $game = $this->getMockBuilder(Game::class)
                     ->setMethods(['getAvarageScore','getGenreCode'])
                     ->getMock();
        $game->method('getAvarageScore')->willReturn(10);

        $user = $this->getMockBuilder(User::class)
                     ->setMethods(['getGenreCompatibility'])
                     ->getMock();
        $user->method('getGenreCompatibility')->willReturn(2);

        $this->assertFalse($game->isRecommended($user));
    }

    public function testIsRecommended_WithCompatibility10AndScore10_ReturnsTrue()
    {
        $game = $this->getMockBuilder(Game::class)
                     ->setMethods(['getAvarageScore','getGenreCode'])
                     ->getMock();
        $game->method('getAvarageScore')->willReturn(10);

        $user = $this->getMockBuilder(User::class)
                     ->setMethods(['getGenreCompatibility'])
                     ->getMock();
        $user->method('getGenreCompatibility')->willReturn(10);

        $this->assertTrue($game->isRecommended($user));
    }
}
