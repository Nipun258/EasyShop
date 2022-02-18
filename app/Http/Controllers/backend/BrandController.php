<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function BrandView(){

       $brands = Brand::latest()->get();
       return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request)
    {    
        $validatedData = $request->validate([
            'brand_name_en' => 'required|string|max:255',
            'brand_name_sin' => 'required|string|max:255',
            'brand_image' => 'required'
        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_sin.required' => 'Input Brand Sinhala Name',
        ]);

         $image = $request->file('brand_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
         $save_url = 'upload/brand/'.$name_gen;

         Brand::insert([

            'brand_name_en' => $request->brand_name_en,
            'brand_name_sin' => $request->brand_name_sin,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_sin' => strtolower(str_replace(' ','-',$request->brand_name_sin)),
            'brand_image' => $save_url,
         ]);


         $notification = array(
           'message' => 'New Brand Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);

     }

     public function BrandEdit($id){

        $brand = Brand::findorFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
     }


     public function BrandUpdate(Request $request){

        $brand_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('brand_image')){
         
         unlink($old_image);
         $image = $request->file('brand_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
         $save_url = 'upload/brand/'.$name_gen;

         Brand::findorFail($brand_id)->update([

            'brand_name_en' => $request->brand_name_en,
            'brand_name_sin' => $request->brand_name_sin,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_sin' => strtolower(str_replace(' ','-',$request->brand_name_sin)),
            'brand_image' => $save_url,
         ]);


         $notification = array(
           'message' => 'Brand Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.brand')->with($notification);

        }/*end of the if condition*/

        else{


        Brand::findorFail($brand_id)->update([

            'brand_name_en' => $request->brand_name_en,
            'brand_name_sin' => $request->brand_name_sin,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_sin' => strtolower(str_replace(' ','-',$request->brand_name_sin)),
         ]);


         $notification = array(
           'message' => 'Brand Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.brand')->with($notification);

        }/*end of else condition*/
     }

     public function BrandDelete($id){

        $brand = Brand::findorFail($id);
        $image = $brand->brand_image;
        unlink($image);

        Brand::findorFail($id)->delete();

        $notification = array(
           'message' => 'Brand deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('all.brand')->with($notification);
     }
}
