<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'completed','test_id','desc'
    ];

    public function test()       // relacja n do 1 - jeden projekt ma kilka tasków
    {
        return $this->belongsTo(Test::class);       // zwracamy projekt do którego należy task
        // return $this->belongsTo('\App\Test','test_id');      // można to też napisać ręcznie
    }
    
    public function check(Bool $completed) : void
    {
        $this->update(compact('completed'));
    }
}
