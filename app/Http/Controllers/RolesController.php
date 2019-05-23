<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            $roles = Role::orderBy('name')->get();
            return view('admin.roles.index', ['roles' => $roles]);
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            return redirect('/dashboard/roles');;
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            $this->validate($request, ['name' => 'required']);
            $name = new Role;
            $name->name = $request->input('name');
            $name->save();
            return redirect('/dashboard/roles');
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            return redirect('/dashboard/roles');
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            return redirect('/dashboard/roles');
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            $this->validate($request, ['name' => 'required']);
            $name = Role::find($id);
            $name->name = $request->input('name');
            $name->save();
            return redirect('/dashboard/roles');
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
        if(auth()->user()->role_id == Role::where('name', 'Amane')->first()->id){
            $name = Role::find($id);
            $name->delete();
            return redirect('/dashboard/roles');
        } else {
            return redirect('/');
        }
    }
}
