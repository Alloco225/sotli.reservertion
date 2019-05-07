<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class VoyageursController extends Controller
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
            $v = Role::where('role', 'Voyageur')->first()->id;
            $voyageurs = User::where('role_id', $v)->orderBy('name')->get();

            return view('admin.voyageurs.index', ['voyageurs' => $voyageurs]);;
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
            return redirect('/dashboard/voyageurs');;
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
            return redirect('/dashboard/voyageurs');;
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
            return redirect('/dashboard/voyageurs');;
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
            return redirect('/dashboard/voyageurs');;
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
            return redirect('/dashboard/voyageurs');;
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
            $voyageur = User::find($id);
            $voyageur->delete();
            return redirect('/dashboard/voyageurs');;
        } else {
            return redirect('/');
        }
    }
}
