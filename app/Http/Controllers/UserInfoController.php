<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserInfoController extends Controller
{
    public function update(Request $request)
    { 
        $user = Auth::user();
        
        $data = $request->validate([
            'username' => 'required|string|max:20',
            'firstname' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($data['password'] == "******")
        {
            $data['password'] = $user->password;;
        }else{
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();
        return back()->with('message', 'Your Profile Updated!');
    }
}
