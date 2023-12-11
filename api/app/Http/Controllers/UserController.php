<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ],[
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'Le password non corrispondono.',
            'password.min' => 'La password deve contenere almeno :min caratteri.',
        ]);
        $user->update(['password' => Hash::make($request->get('password'))]);
        return response()->json($user);
        // qui potrei/dovrei ritornare una resource invece che l interesa istanza di user ma vabbè
    }
    public function sendPassword(Request $request, User $user)
    {
        $password = Str::upper(Str::random(8));
        $user->update(['password' => Hash::make($password)]);
        Mail::to($user->email)->send(new SendPassword($user, $password, $request->get('software')));
        return response()->json(['success' => true], 200);
    }
}