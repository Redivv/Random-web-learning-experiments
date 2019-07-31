<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()       // konstruktor odpala się zawsze przy wejściu na stronę która używa tego kontrolera
    {
        $this->middleware('auth');      // przy wejściu na stronę - weryfikujemy czy jesteś zalogowany
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
