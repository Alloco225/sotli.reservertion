<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Ville;
use App\Itineraire;
use App\Depart;
use App\Question;
use App\Newsletter;
use App\User;
use App\DepartVoyageur;

class AdminController extends Controller
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
    //
    public function index()
    {
        // Fetch 'em all ! \(^^)/
        if(auth()->user()->role->name == 'Amane'){
            $villes = Ville::all();
            $itineraires = Itineraire::all();
            return view('admin.dashboard', 
                    compact('villes', 'itineraires'));
        } else {
            return redirect('/');
        }
    }
}
