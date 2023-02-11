<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('users.index',compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function activation(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->update([
            'is_active' => $request->is_active
        ]);

        return redirect()->back();
    }
}
