<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);

        return view('admin.users.index')->with('users', $users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'min:4|max:120|required',
            'email'=>'min:4|max:120|required|unique:users',
            'password'=>'min:8|max:120|required|'
        ];

        $this->validate($request, $rules);
        $user = new User($request->all());
        $user->password=bcrypt($user->password);

        if($user->save())
            Flash::success('Usuario: '.$user->name.', creado con éxito');
        else
            Flash::error('Error: '.$user->name.', no pudo ser creado.');

        return redirect()->route('users.index');

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
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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

        $rules=[
            'name'=>'min:4|max:120|required',
            'email'=>'min:4|max:120|required'
        ];
        $this->validate($request, $rules);

        $user = User::find($id);

        $user->fill($request->all());


        if($user->save())
            Flash::success('Usuario: '.$user->name.', editado con éxito');
        else
            Flash::error('Error: '.$user->name.', no pudo ser editado.');

        return redirect()->route('users.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->delete())
            Flash::error('Usuario: '.$user->name.', eliminado con éxito.');
        else
            Flash::error('Error: '.$user->name.', no pudo ser eliminado.');

        return redirect()->route('users.index');
    }
}
