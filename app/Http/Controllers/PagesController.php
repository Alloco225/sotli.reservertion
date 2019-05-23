<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Itineraire;
use App\Question;
use App\Role;
use App\Ville;
use App\User;

class PagesController extends Controller
{
    // Index
    public function index()
    {
        $promotions = Itineraire::orderBy('tarif')->get()->take(3);
        // dd($promotions);
        $destinations = Ville::all()->take(3);
        $villes = Ville::orderBy('name')->get();
        return view('welcome', compact('promotions', 'destinations', 'villes'));
    }
    // search
    public function search(Request $request)
    {
        $this->validate($request, [ ]);
        $ville_depart = $request->input('ville_depart');
        $ville_arrivee = $request->input('ville_arrivee');
        
        $itineraires = Itineraire::where('ville_depart', $ville_depart)->orWhere('ville_arrivee', $ville_arrivee)->get();
        return view('pages.search', ['itineraires' => $itineraires]);

    }
    // Full search
    public function full_search(Request $request)
    {
        $this->validate($request, [ ]);
        
    }
    
    // Reserver
    public function reservation()
    {
        return view('pages.reservation');
    }
    // Services
    public function services()
    {
        return view('pages.services');
    }
    
    // About
    public function about()
    {
        return view('pages.about');
    }
    // Contact
    public function contact()
    {
        return view('pages.contact');
    }
    
}
