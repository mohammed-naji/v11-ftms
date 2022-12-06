<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function profile()
    {
        // $user = User::find(1);
        // $profile = Profile::where('user_id', $user->id)->first();
        // dd($user->profile);

        // $profile = Profile::find(1);

        // dd($profile->user);

        $users = User::with('profile')->get();
        // $users = User::get();

        // dd($users);

        return view('users', compact('users'));
    }
}
