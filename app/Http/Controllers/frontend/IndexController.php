<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){

        return view('frontend.index');
    }

    public function UserLogout(){

        Auth::logout();

        return redirect()->route('login');
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

        public function UserProfileUpdate(Request $request)
    {    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15'
        ]);

         $data = User::find(Auth::user()->id);
         $data->name = $request->name;
         $data->email = $request->email;
         $data->phone = $request->phone;

         if ($request->file('profile_photo_path')) {
            
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;

         }
         $data->save();

         $notification = array(
           'message' => 'User profile updated Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }//profile update page


    public function UserChangePassword(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    }

    public function UserPasswordUpdate(Request $request){
        
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }


    } // End Metod 

}
