<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // will show register page
    public function register(){
        return view("account.register");
    }

    // will register a user
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        };

        // Register the user
        $user = new User();
        $user-> name = $request->name;
        $user-> email = $request->email;
        $user-> password = Hash::make($request->password);
        $user -> save();

        return redirect()->route('account.login')->with('success','Registration Succuessful!');
    }

    public function login(){
        return view("account.login");
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        if ($validator->fails()){
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        };

        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){
            return redirect()->route('account.profile');
        }else{
            return redirect()->route('account.login')->with('error','Invalid credentials.');
        }
    }
    
    // Will show user profile
    public function profile(){
        $user = User::find(Auth::user()->id);
        
        return view("account.profile",[
            'user'=>$user
        ]);
    }

    // will update user profile
    public function updateProfile(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.',id',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // upload image
        if(!empty($request->image)){

            File::delete(public_path('uploads/profile/'.$user->image));
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/profile'),$imageName);
            $user->image = $imageName;
            $user->save();
        }
    
        return redirect()->route('account.profile')->with('success','Updated Successfully');
    }

    // deactivate user
    public function deleteProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if (!empty($user->image)) {
            File::delete(public_path('uploads/profile/'.$user->image));
        }
        if($user){
            $user->delete();
            Auth::logout();
            return redirect()->route('account.register')->with('success','Account deleted successfully.');
        }
        return redirect()->route('account.profile')->with('error','Account could not be deleted.');
    }

    // logout
    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

}
