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

Route::get('/','PagesController@home');         // przy wejściu na roota - homepage przekieruj na kontroler (zamiast wykonywać funkcje)
Route::get('/contact','PagesController@contact');
Route::get('/about','PagesController@about');

// Route::get('/', function () {
//     $tasks = [
//         'Kill Yourself',
//         'Eat Shit',
//         'Die'
//     ];
//     return view('welcome',[         // Przesyłanie danych do widoku jest możliwe przez 2 argument view()
//         'tasks' => $tasks,
//         'nugga' => request('title') // request() (na moją obecną wiedzę) pobiera geta o tym samym tytule
//     ]);

//     //return view('welcome')->withTasks($tasks)->withNugga(request('title'));     // identyczne
// });

// Route::get('/contact',function(){
//     return view('contact');
// });

// Route::get('/about',function(){
//     return view('about');
// });