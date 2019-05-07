<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ville;
use App\Role;

class VillesController extends Controller
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
            $villes = Ville::orderBy('name')->get();
            return view('admin.villes.index', ['villes' => $villes]);
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
            return redirect('/dashboard/villes');;
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
            $this->validate($request, ['name' => 'required']);
            if(Ville::where('name', $request->input('name'))->count() == 0){
                $ville = new Ville;
                $ville->name = $request->input('name');
                $ville->description = $request->input('description');
                $ville->save();
                return redirect('/dashboard/villes');
            } else{
                return redirect('/dashboard/villes');
            }
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
            return redirect('/dashboard/villes');
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
            return redirect('/dashboard/villes');
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
            $this->validate($request, ['name' => 'required']);
            $ville = Ville::find($id);
            $ville->name = $request->input('name');
            $ville->description = $request->input('description');
            $ville->save();
            return redirect('/dashboard/villes');
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
            $ville = Ville::find($id);
            $ville->delete();
            return redirect('/dashboard/villes');
        } else {
            return redirect('/');
        }
    }
}
