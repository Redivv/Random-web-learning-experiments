<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_have_a_team()          // funkcja sprawdzająca relację między userem a teamem (może mieć jedne team)
    {
        // Given
        $user = factory('App\User')->create();

        // When
        $user->team()->create([
            'name' => 'ociehuj',
        ]);

        // Then
        $this->assertEquals('ociehuj', $user->team->name);      // zakładamy, że dodany team jest tym z którym jest relacja
        
    }
    
}
