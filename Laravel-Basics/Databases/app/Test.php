<?php

namespace App;

use App\Mail\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [         // zmienna określająca kolumny które mogą zostać masowo wypełnione metodą create, reszta zostanie pominięta
        'title',
        'desc',
        'owner_id'
    ];
    /////////////////////////////////           WYBIERZ JEDNO                   ///////////////////////////////


    //protected $guarded = array();           // zmienna określająca kolumny, które nie mogą zostać masowo wypełnione metodą create pusta oznacza, że wszystkie mogą

    public function tasks()     // defniniujemy wewnątrz modelu nową relacje
    {
        return $this->hasMany(Task::class);     // wywołując ją zwracamy wszystkie (hasMany) związane z tym modelem ($this) Taski po id (test_id)
    }

    // protected static function boot(){
    //     parent::boot();        // przy tworzeniu funkcji boot dla childa pamiętajmy o wpierw uruchomieniu boota rodzica

    //     static::created(function ($project){        // tworzymy wewnętrzną funkcję dla modelu, która przy evencie (created czyli po stworzeniu i zapisaniu modelu) wykonuje zapisane kroki

    //         Mail::to($project->owner->email)->send(new ProjectCreated($project));
    //     });
    // }

    public function addTask(string $desc) : void
    {
        $this->tasks()->create(compact('desc'));            // korzystając z już zadeklarowanej w modelu relacji można w ten prostszy sposób dodać nowy element

        // return Task::create([
        //     'test_id'    => $this->id,
        //     'desc'       => $desc   
        // ]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}