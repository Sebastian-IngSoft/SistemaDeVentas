<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::orderby('name','desc')->get();
        return view('users.index',compact('users'));
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.index');
    }
}
