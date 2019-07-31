<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/* 
    Popularna konwencja nazywania funkcji i ścieżek

    GET /projects 'index'

    GET /projects/create 'create'

    GET /projects/1 'show'

    POST /projects 'store'

    GET /projects/1/edit 'edit'

    PATCH /projects/1 'update'

    DELETE /projects/1 'destroy'



*/

use \App\Services\Twitter;

// app()->bind('cos',function(){       // umieszczamy w AppServiceContainer element 'cos' który przy późniejszym wykorzystaniu (resolve) ma zwrócić nowy obiekt klasy Cos
//     return new Cos;
// });

// app()->singleton('cos',function(){   // tym razem umieszczamy pojedyńczy element 'cos' wcześniej można było wyciągać co raz to nowe obiekty - teraz funkcja zwrotu nowego obiektu wykona się tylko raz
//     return new Cos;
// });

app()->singleton('App\Services\Twitter',function(){   // należy pamiętać, że chcąc wykorzystać element z containera w kontrolerze laravel najpierw szuka w containerze i jeśli nie ma drugiego parametru w metodzie to musi ten element znaleźć w containerze - dajemu mu nazwę jak ścieżka do klasy
    return new Twitter('jakisstring');
});

Route::get('/', function () {
    // dd(app('cos'),app('cos'));
    // dd(app('\App\Cos'));         // wyciągamy i wyrzucamy na ekran efekt wyciągnięcia cos-a. JEŚLI elementu nie ma w AppServiceContainer laravel będzie szukał klasy o takiej nazwie
    return view('welcome');
});

Route::resource('projects', 'ProjectsController')/*->middleware('can:update,test')*/;      // rejestruje identyczne ścieżki co te poniżej z takimi samymi nazwami funkcji - utarta konwencja

Route::patch('/tests/{test}/tasks/{task}', 'ProjectTasksController@update');

Route::post('/tests/{test}/tasks', 'ProjectTasksController@store');

// Route::get('/projects', 'ProjectsController@index');        // pobieranie wszystkich

// Route::get('/projects/create', 'ProjectsController@create');        // wyświetlanie formularza

// Route::get('/projects/create/{project}', 'ProjectsController@show');    // {project} oznacza, że będzie tu przekazany parametr (id) do wykorzystania w zapytaniach

// Route::post('/projects', 'ProjectsController@store');       // według przyjętej popularnej konwencji - store oznacza, że tutaj będą przesyłane jakieś nowe dane

// Route::get('/projects/{project}/edit', 'ProjectsController@edit');  // wyświetlanie formularza edycji konkretnego projektu

// Route::patch('/projects/{project}','ProjectsController@update');    // request patch (da fuq?) który zapisuje nową wersję projektu

// Route::delete('/projects/{project}','ProjectsController@destroy');      // request delete (da fuq?) który usuwa wybrany post


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
