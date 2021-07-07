<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

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

    public function disable()
    {
        $user = Auth::user();
        $user->active = '0';
        $user->save();
        auth()->logout();
        return redirect('/home');
    }

    public function disableOne($userid)
    {
        $user = DB::table('users')->where('id', $userid)->value('active');
        if ($user == 0){
            $user = DB::table('users')->where('id', $userid)->update(['active' => 1]);
        }else{
            $user = DB::table('users')->where('id', $userid)->update(['active' => 0]);
        }
        return back()->with('message', 'User is Updated!');
    }

    public function deleteOne($userid)
    {
        DB::table('users')->where('id', $userid)->delete();
        return back()->with('message', 'User is Updated!');
    }

}
