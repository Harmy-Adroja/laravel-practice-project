<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateProfileRequest;

use Illuminate\Http\Request;

class Profilecontroller extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        {
           // dd($request->user());
            //dd($request->file('avatar'));
            auth()->user()->update($request->only('name', 'email'));
    
            if ($request->input('password')) {
                auth()->user()->update([
                    'password' => bcrypt($request->input('password'))
                ]);
            }
            //auth()->user()->update(['avatar'=>'test']);
            //dd(auth()->user());
            $path=$request->file('avatar')->store('avatars','public');
            //dd($path);
           // auth()->user()->update(['avatar'=> storage_path('app')."/$path"]);
           auth()->user()->update(['avatar'=>$path]);
            

            return redirect()->route('profile.update')->with('message', 'Profile saved successfully');
        }
    }
}
