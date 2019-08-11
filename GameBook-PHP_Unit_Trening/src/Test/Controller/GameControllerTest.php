<?php

use Goutte\Client;
use GuzzleHttp\Client as ClientG;
use PHPUnit\Framework\TestCase;

class GameControllerTest extends TestCase
{
    public function setUp() : void          // setUp to funkcja która wykonuje się przed każdym testem dlatego można jej np użyć do restartu bazydanych
    {
        $mysql_host = "localhost";
        $mysql_user = "wipaka_rajczogli";
        $mysql_password = "kauczuk1";
        # MySQL with PDO_MYSQL  
        $db = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_password);

        $query = file_get_contents(__DIR__."/../fixture.sql");
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    public function setUpBeforeClass()      // podobna do powyższej, ale ta wykonuje się przed pierwszym testem, zwykły prze każdym
    {

    }
    public function testIndex_Has6UlWithLi()
    {
        $client = new Client();
        $response = $client->request('GET','http://port.loc/');
        // $this->assertRegExp('/<ul>/', $response->getBody()->getContents());
        $this->assertCount(6, $response->filter('ul > li'));
    }

    public function testApiGames_WithUsers_Returns6Items()
    {
        $client = new ClientG();
        $response = $client->request('GET', 'http://www.port.loc/api-games.php',[
            'json' => [
                'user' => '1',
            ],
        ]);

        $json = $response->getBody()->getContents();
        $this->assertJsonStringEqualsJsonString(file_get_contents(__DIR__.'\api-games-user.json'), $json);     // takie założenie zwróci lepsze informacje o błędach niż assertEquals
    }

    public function testAddRating_WithGET_HasEmptyForm()
    {
        $client = new Client();
        $response = $client->request('GET','http://port.loc/add-rating.php?game=1');
        $this->assertCount(1, $response->filter('form'));
        $this->assertEquals('',$response->filter('form input[name=score]')->attr('value'));
    }

    public function testAddRating_WithPOST_IsRedirect()
    {
        $client = new ClientG();
        $response = $client->request('POST',
            'http://port.loc/add-rating.php?game=1',
            [
                'allow_redirects' => false,
                // 'form_params' => [
                //     'score' => '5'
                // ],
                'multipart' => [
                    [
                        'name' => 'score',
                        'contents' => '5',
                    ],
                    [
                        'name' => 'screenshot',
                        'contents' => fopen(__DIR__.'/screenshot.jpg', 'r')     // aby zasymulować przesłanie pliku - normalnie go otwieramy
                    ]
                ]
            ]    
        );
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));

        $pdo = new PDO(
            'mysql:host=localhost;dbname=game_test',
            'root',
            '^Qj5RC3M3#'
        );
        
        $statement = $pdo->prepare('SELECT * FROM rating');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $result);
        $this->assertEquals([
            'user_id' => '1',
            'game_id' => '1',
            'score'   => '5',
        ], $result[0]);

        $this->assertFileExists(__DIR__.'/../../../web/screenshots/1-1.jpg');
    }
}