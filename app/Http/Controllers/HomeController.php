<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itineraire;
use App\Voyage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    // 
    public function mes_voyages()
    {
        $itineraires = Itineraire::all();
        return view('home', ['itineraires' => $itineraires]);
    }
}
