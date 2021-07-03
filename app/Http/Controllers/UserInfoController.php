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
        $address = $user->address;
        $contact = $user->contact;
        
        $data = $request->validate([
            'username' => 'required|string|max:20',
            'firstname' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
//            'email' => 'required|string|email|max:255|',
//            'password' => 'required|string|min:6|confirmed',
            'streetaddress' => 'required|string|max:255',
            'city' => 'required|string|max:20',
            'province' => 'required|string|max:20',
            'country' => 'required|string|max:20',
            'postalcode' => 'required|string|max:20',
            'number'=>'required|regex:/[0-9]{9}/',

        ]);

        // if ($data['password'] == "******")
        // {
        //     $data['password'] = $user->password;;
        // }else{
        //     $data['password'] = Hash::make($data['password']);
        // }

        $user->username = $data['username'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->save();

        $address->streetaddress = $data['streetaddress'];
        $address->city = $data['city'];
        $address->province = $data['province'];
        $address->country = $data['country'];
        $address->postalcode = $data['postalcode'];
        $address->default = 'No';
        $address->save();

        $contact->value = $data['number'];
        $contact->save();

        return back()->with('message', 'Your Profile Updated!');
    }
}
