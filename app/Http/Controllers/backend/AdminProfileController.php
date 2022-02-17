<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{
    public function ProfileView()
    {
        $adminData = Admin::find(1);

        return view('admin.profile.view',compact('adminData'));
    }

        public function ProfileEdit()
    {
        $editData = Admin::find(1);

        return view('admin.profile.edit',compact('editData'));
    }

    public function ProfileStore(Request $request)
    {    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

         $data = Admin::find(1);
         $data->name = $request->name;
         $data->email = $request->email;

         if ($request->file('profile_photo_path')) {
            
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;

         }
         $data->save();

         $notification = array(
           'message' => 'Admin profile updated Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('admin.profile.view')->with($notification);
    }//profile update page

    public function PasswordView()
    {
        return view('admin.profile.edit_password');
    }

    public function PasswordUpdate(Request $request){
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPassword = Admin::find(1)->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }


    } // End Metod 
}
