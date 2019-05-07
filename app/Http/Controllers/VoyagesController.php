<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voyage;
use App\Itineraire;
use App\Role;
use App\User;

class VoyagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            $voyageurs = User::where('role_id', Role::where('role', 'Voyageur')->first()->id)->orderBy('name')->get();
            $voyages = Voyage::orderBy('itineraire_id')->get();
            $itineraires = Itineraire::orderBy('ville_depart')->get();
            return view('admin.voyages.index', ['voyages' => $voyages, 'itineraires' => $itineraires]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            return redirect('/dashboard/voyages');;
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            $this->validate($request, ['itineraire_id' => 'required','date' => 'required','depart' => 'required',]);
            $voyage = new Voyage;
            $voyage->user_id = auth()->user()->id;
            $voyage->itineraire_id = $request->input('itineraire_id');
            $voyage->date = $request->input('date');
            $voyage->depart = $request->input('depart');
            $voyage->save();
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }
    // 
    public function addVoyageur(Request $request)
    {
        
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            // $this->validate($request, ['itineraire_id' => 'required','date' => 'required','depart' => 'required',]);
            // $voyageurs = User::where('role_id', Role::where('role', 'Voyageur')->first()->id)->orderBy('name')->get();
            // foreach ($request->input('Voyageur')) {
            //     # code...
            // }            
            $voyage = new Voyage;
            $voyage->user_id = auth()->user()->id;
            $voyage->itineraire_id = $request->input('itineraire_id');
            $voyage->date = $request->input('date');
            $voyage->depart = $request->input('depart');
            $voyage->save();
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            $this->validate($request, ['itineraire_id' => 'required','date' => 'required','depart' => 'required',]);
            $voyage = Voyage::find($id);
            $voyage->user_id = auth()->user()->id;
            $voyage->itineraire_id = $request->input('itineraire_id');
            $voyage->date = $request->input('date');
            $voyage->depart = $request->input('depart');
            $voyage->save();
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            $voyage = Voyage::find($id);
            $voyage->delete();
            return redirect('/dashboard/voyages');
        } else {
            return redirect('/');
        }
    }
}
