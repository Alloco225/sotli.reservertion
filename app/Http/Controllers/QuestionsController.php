<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Role;

class QuestionsController extends Controller
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
            $questions = Question::orderBy('created_at', 'desc')->get();
            return view('admin.questions.index', ['questions' => $questions]);
        } else {
            return redirect('/dashboard/questions');
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
            return redirect('/dashboard/questions');
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
            $this->validate($request, ['name' => 'required', 'email' => 'required', 'message' => 'required']);

            $question = new Question;
            $question->name = $request->input('name');
            $question->email = $request->input('email');
            $question->telephone = $request->input('telephone');
            $question->company = $request->input('company');
            $question->message = $request->input('message');
            $question->save();
            // return back();
            return redirect('/');
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
            return redirect('/dashboard/questions');
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
            return redirect('/dashboard/questions');
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
            $this->validate($request, ['name' => 'required', 'email' => 'required','question' => 'required',]);
            $question = Question::find($id);
            $question->name = $request->input('name');
            $question->email = $request->input('email');
            $question->telephone = $request->input('telephone');
            $question->company = $request->input('company');
            $question->question = $request->input('question');
            $question->save();
            return redirect('/dashboard/questions');
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
            $question = Question::find($id);
            $question->delete();

            return redirect('/dashboard/questions');
        } else {
            return redirect('/');
        }
    }
}
