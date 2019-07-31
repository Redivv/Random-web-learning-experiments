<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsTest extends TestCase
{
use RefreshDatabase;            // ten trait sprawia, że wszelkie testy, które dokonują zmian w bazie po ich wykonaniu cofną dokonane zmiany
    
    /** @test */
    public function guests_cannot_create_teams()
    {
        $this->post('/teams')->assertRedirect('/login');
    }
    
    
     /** @test */           // klamra oznaczająca test dla PhpUnit, ewentualnie na początku nazwy funkcji dodać test
     public function user_can_create_a_team()     // test sprawdzający feature - zalogowany użytkownik może dodać nowy team
     {
        $this->withoutExceptionHandling();  // normalnie w testach laravel przejmuje wszelkie wyjątki i błędy, tutaj prosimy aby tego nie robił
         // Given (warunek) Jestem zalogowanym użytkownikiem
        $this->actingAs(factory('App\User')->create());         // laravelowa funkcja, która sprawia, że jest się zalogowanym jako (argument) tutaj wytworzony w factory user
         // When (kiedy) trafię na endpoint /teams chcąc stworzyć nowy team
        $this->post('/teams',[          // funkcja, która przenosi danym requestem na dany endpoint z podanymi parametrami
            'name' => 'ociehuj',
        ]);
         // Then (co) wtedy powinen być nowy team w bazie
        $this->assertDatabaseHas('teams',[      // standard przy testach - zakładamy pewną rzecz, jeśli test ma się powieść to warunek musi być spełniony, zakładamy że jest rekord w bazie o podanych atrybutach
            'name' => 'ociehuj',
        ]);
     }   
}
