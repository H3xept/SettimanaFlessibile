<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userIsMod() == NULL) return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
        return view('layouts.admin.edituser')->withUser(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($target_id)
    {
        $rules = array(
            'name' => 'required',
            'surname' => 'required',
            'class' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect(route("admin"))->withErrors(["Uno o più campi immessi non validi."]);
        } else {
            $user = User::find($target_id);
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->class = Input::get('class');
            $user->username = strtolower(str_replace(' ', '', Input::get('name').Input::get('surname').Input::get('class')));
            $user->save();
        }
        return redirect(route("admin"))->withSuccess("Utente ".$user->name." ".$user->surname." modificato con successo.");
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
    }
}
