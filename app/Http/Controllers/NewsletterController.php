<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Role;
use App\User;

class NewsletterController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->role_id == Role::where('role', 'Amane')->first()->id){
            $mails = Newsletter::orderBy('created_at')->get();
            return view('admin.newsletter.index', ['mails'=> $mails]);
        } else{
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
            return redirect('/dashboard/newseletter');
        } else{
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
            $this->validate($request, [ 'email' => 'required']);
            $mail = new Newsletter;
            $mail->email = $request->input('email');
            $mail->save();
            return redirect('/dashboard/newsletter');
        } else{
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
                return redirect('/dashboard/newseletter');
            } else{
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
                return redirect('/dashboard/newseletter');
            } else{
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
                $this->validate($request, [ 'email' => 'required']);
                $mail = Newsletter::find($id);
                $mail->email = $request->input('email');
                $mail->save();
                return redirect('/dashboard/newseletter');
            } else{
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
            $mail = Newsletter::find($id);
            $mail->delete();
            return redirect('/dashboard/newsletter');
        } else{
                return redirect('/');
            }
    }
}
