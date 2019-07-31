<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $tasks = [
            'Kill Yourself',
            'Eat Shit',
            'Die'
        ];

        return view('welcome',[         // Przesyłanie danych do widoku jest możliwe przez 2 argument view()
            'tasks' => $tasks,
            'nugga' => request('title') // request() (na moją obecną wiedzę) pobiera geta o tym samym tytule
        ]);

        //return view('welcome')->withTasks($tasks)->withNugga(request('title'));     // identyczne
    }

    public function contact(){
        return view('contact');
    }

    public function about(){
        return view('about');
    }
}
