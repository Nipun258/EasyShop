<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function SliderView(){

       $sliders = Slider::latest()->get();
       return view('backend.slider.slider_view',compact('sliders'));

    }

    public function SliderStore(Request $request){

        $validatedData = $request->validate([

            'slider_img' => 'required'
        ],[
            'slider_img.required' => 'Please select atleast one image',

        ]);

         $image = $request->file('slider_img');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
         $save_url = 'upload/slider/'.$name_gen;

         Slider::insert([

            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
         ]);


         $notification = array(
           'message' => 'New Slider Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('manage.slider')->with($notification);

    }

    public function SliderEdit($id){

        $slider = Slider::findorFail($id);
        return view('backend.slider.slider_edit',compact('slider'));

    }

    public function SliderUpdate(Request $request){

        $slider_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('slider_img')){
         
         unlink($old_image);
         $image = $request->file('slider_img');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
         $save_url = 'upload/slider/'.$name_gen;

         Slider::findorFail($slider_id)->update([

            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
         ]);


         $notification = array(
           'message' => 'Slider Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('manage.slider')->with($notification);

        }/*end of the if condition*/

        else{


        Slider::findorFail($slider_id)->update([

            'title' => $request->title,
            'description' => $request->description,
         ]);


         $notification = array(
           'message' => 'Slider Data Update Without image Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('manage.slider')->with($notification);

        }/*end of else condition*/
        
    }

    public function SliderDelete($id){

        $slider = Slider::findorFail($id);
        $image = $slider->slider_img;
        unlink($image);

        Slider::findorFail($id)->delete();

        $notification = array(
           'message' => 'Slider deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('manage.slider')->with($notification);
    }

    public function SliderInactive($id){
        Slider::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Slider Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }//end method


  public function SliderActive($id){
      slider::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


}
