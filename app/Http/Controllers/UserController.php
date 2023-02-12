<?php

namespace App\Http\Controllers;

use App\Mail\InviteMail;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => 1,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.list')->with('success_message','User created successfully');
    }

    public function activation(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'is_active' => $request->is_active
        ]);

        return redirect()->back();
    }

    public function inviteCreate(Request $request)
    {
        $project_id = $request->get('project_id');
        // todo - add record to usr project table
        return view('users.invite',compact('project_id'));
    }
    public function invite(Request $request)
    {
        ProjectUser::create([
            'project_id' => $request->project_id,
            'employee_email' => $request->email
        ]);
//        Mail::to($request->email)->send(new InviteMail());

        return redirect()->back()->with('success_message','Invitation sent successfully!');
    }
}
