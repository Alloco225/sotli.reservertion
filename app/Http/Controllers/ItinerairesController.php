<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itineraire;
use App\Depart;
use App\Ville;
use App\Role;

class ItinerairesController extends Controller
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
            $itineraires = Itineraire::orderBy('ville_depart')->get();
            $villes = Ville::orderBy('name')->get();
            return view('admin.itineraires.index', ['itineraires' => $itineraires, 'villes' => $villes]);
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
            return redirect('/dashboard/itineraires');;
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
            $this->validate($request, ["ville_depart" => "required", "ville_arrivee" => "required"]);
            $vd = $request->input('ville_depart');
            $va = $request->input('ville_arrivee');
            $itineraires = Itineraire::where('ville_depart', $request->input('ville_depart'))
                                    ->where('ville_arrivee', $request->input('ville_arrivee'))->get();
            if(count($itineraires) == 0){
                if($request->input('ville_depart') != $request->input('ville_arrivee')){
                    $itineraire = new Itineraire;
                    $itineraire->ville_depart = $request->input('ville_depart');
                    $itineraire->ville_arrivee = $request->input('ville_arrivee');
                    $itineraire->prix = $request->input('prix') ?? 1500;
                    $itineraire->depart_1 = $request->input('depart_1') ?? "08:00:00";
                    $itineraire->depart_2 = $request->input('depart_2');
                    $itineraire->depart_3 = $request->input('depart_3');
                    $itineraire->depart_dernier = $request->input('depart_dernier') ?? "20:00:00";
                    $itineraire->save();
                    return redirect('/dashboard/itineraires')->withSuccess('Itineraire Ajouté');
                } else {
                    return redirect('/dashboard/itineraires')->withError("La ville départ ne peut pas être la ville d'arrivée");
                }
            }
            return redirect('/dashboard/itineraires')->withError('Ce itinéraire existe déja');
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
            return redirect('/dashboard/itineraires');
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
            return redirect('/dashboard/itineraires');
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

            $this->validate($request, ["ville_depart" => "required", "ville_arrivee" => "required"]);
            $itineraire = Itineraire::find($id);
            $itineraire->ville_depart = $request->input('ville_depart');
            $itineraire->ville_arrivee = $request->input('ville_arrivee');
            $itineraire->prix = $request->input('prix');
            $itineraire->depart_1 = $request->input('depart_1');
            $itineraire->depart_2 = $request->input('depart_2');
            $itineraire->depart_3 = $request->input('depart_3');
            $itineraire->depart_dernier = $request->input('depart_dernier');
            $itineraire->save();
            
            return redirect('/dashboard/itineraires');
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
            $itineraire = Itineraire::find($id);
            $itineraire->delete();
            return redirect('/dashboard/itineraires');
        } else {
            return redirect('/');
        }
    }
}
