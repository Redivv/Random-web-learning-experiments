<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];      // pusta tablica guarded oznacza, że każdy atrybut może zostać masowo zapełniony
}
