<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function EnglishLan(){
        
        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
        return redirect()->back();

    }

    public function SinhalaLan(Request $request){
        
        session()->get('language');
        session()->forget('language');
        Session::put('language','sinhala');
        return redirect()->back();

    }
}
