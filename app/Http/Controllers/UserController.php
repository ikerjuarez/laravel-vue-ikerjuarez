<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/seeUsers');
    }

    public function viewUsers(){
        $users = User::all();
        return view('user.seeUsers')->with('users', $users);
    }

    public function profile(){
        $profile = User::find($_POST['idProfile']);
        return view('user.updateUser')->with('userToUpdate',$profile);
    }

    public function updateUserView($id){
        $userToUpdate = User::find($id);
        return view('user.updateUser')->with('userToUpdate',$userToUpdate);
    }

    public function update(){
        $req = request()->all();
        $user = User::find($req['id']);
        $user->name = $req['name'];
        $user->email = $req['email'];
        $user->password = $req['password'];
        $user->password = Hash::make($req['password']);
        $user->save();
        return redirect('/seeUsers');
    }

    public function getUserById($id){
        $user = User::find($id);
        return $user;
    }
}
