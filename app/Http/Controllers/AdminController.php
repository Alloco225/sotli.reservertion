<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

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
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            return view('admin.dashboard');
        } else {
            return redirect('/');
        }
    }
}
