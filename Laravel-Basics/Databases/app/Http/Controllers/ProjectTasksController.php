<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Test;



class ProjectTasksController extends Controller
{
    public function store(Test $test)
    {
        $validated = request()->validate([          // walidacja tytułu zadania
            'task'       => 'required | min:3'
        ]);

        $test->addTask($validated['task']);         // wywołanie metody z modelu

        // Task::create([
        //     'test_id'    => $test->id,
        //     'desc'       => $validated['task']
        // ]);

        return back();
    }

    public function update($project, Task $task)
    {
        request()->has('completed') ? $task->check(true) : $task->check(false) ;    // zastosowana enkapsulacja czyli umieszczenie funkcji jako metodę w klasie po to aby przekaz był jaśniejszy

        return back();  // zwraca redirect na poprzednią ścieżkę
    }
}
