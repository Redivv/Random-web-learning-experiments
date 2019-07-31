<?php   

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../Entity/Game.php';
require __DIR__ . '/../../Entity/User.php';

class UserTest extends TestCase
{
    public function testGenreCompatibility_With8And6_Return7()
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
        
        $user = $this->getMockBuilder('lack')
                     ->setMockClassName('User')
                     ->setMethods(['findRatingsByGenre'])
                     ->getMock();
        $user->method('findRatingsByGenre')->willReturn([$rating1,$rating2]);

        $this->assertEquals(7, $user->getGenreCompatibilty('zombie'));
    }

    public function testRatingsByGenre_With1ZombieAnd1Shooter_Returns1Zombie()
    {
        $zombiesGame = $this->getMockBuilder(Game::class)
                            ->setMethods(['getGenreCode'])      // Mocked getGenreCode Method
                            ->getMock();
        $zombiesGame->method('getGenreCode')->willReturn('zombies');

        $shooterGame = $this->getMockBuilder(Game::class)
                            ->setMethods(['getGenreCode'])      // Mocked getGenreCode Method
                            ->getMock();
        $shooterGame->method('getGenreCode')->willReturn('shooter');

        $rating1 = $this->getMockBuilder('lack')            // Mocked Rating Class
                        ->setMockClassName('Rating')
                        ->setMethods(['getGame'])           // Mocked getGame Method
                        ->getMock();
        $rating1->method('getGame')->willReturn($zombiesGame);
        
        $rating2 = $this->getMockBuilder('lack')            // Mocked Rating Class
                        ->setMockClassName('Rating')
                        ->setMethods(['getGame'])           // Mocked getGame Method
                        ->getMock();
        $rating2->method('getGame')->willReturn($shooterGame);

        $user = $this->getMockBuilder(User::class)
                     ->setMethods(['getRatings'])
                     ->getMock();
        $user->method('getRatings')->willReturn([$rating1,$rating2]);

        $ratings = $user->findRatingsByGenre('zombies');
        $this->assertCount(1, $ratings);
        foreach ($ratings as $rating) {
            $this->assertEquals('zombies', $rating->getGame()->getGenreCode());
        }
    }

}