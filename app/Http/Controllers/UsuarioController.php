<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsuarioController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('usuarios.users-table', compact('users'));
    }

    // public function create()
    // {
    //     return view('usuarios.users-table');
    // }

    // public function store(Request $request)
    // {
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = $request->password;
    //     $user->save();
    //     return back();
    // }

    // public function show($id)
    // {
    //     $user = User::find($id);
    //     return view('usuarios.show', compact('user'));
    // }

    // public function edit($id)
    // {
    //     $user = User::find($id);
    //     return view('usuarios.edit', compact('user'));
    // }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = $request->password;
        }
        $user->save();
        //return index function
        $users = User::all();
        return view('usuarios.users-table', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
