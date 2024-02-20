<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);
        $newUser = User::create($incomingFields);

        //Log the new user in automatically
        auth()->login($newUser);
        
        return redirect('/')->with('success', 'Account created.');

    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/'); //->with('success', 'You have successfully logged in.'); 
        } else {
            return redirect('/')->with('failure', 'Invalid login.'); 
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/'); //->with('success', 'You are now logged out.');    
    }

    public function toggleFavorite(Request $request) {

        $favId = $request->input('favId');

        $propertyId = str_replace("fav-", "", $favId);

        $allfavs = Favorite::where('user_id', auth()->user()->id)->get();
        $exists = $allfavs->where('property_id', $propertyId)->count();
        if ($exists) {
            Favorite::where([['user_id', auth()->user()->id], ['property_id', $propertyId]])->delete();
            return ['unset', $allfavs->count()-1];
        } else {
            Favorite::create(['user_id' => auth()->user()->id, 'property_id' => $propertyId]);
            return ['set', $allfavs->count()+1];
        }
    }


    // These are test functions - DELETE LATER
    public function setSessiondata(Request $request) {
        $request->session()->put('myname', 'leslarson');
        $request->session()->flash('status', 'Task was successful!');
        $data = $request->session()->all();
        return $data;
    }

    public function getSessiondata(Request $request) {
        // $request->session()->put('myname', 'leslarson');
        $values = $request->session()->all();
        return $values;
    }
    // END OF TEST FUNCTIONS

}
