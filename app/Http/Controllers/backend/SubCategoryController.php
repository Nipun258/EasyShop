<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){

       $subcategories = SubCategory::latest()->get();
       $categories = Category::orderBy('category_name_en','ASC')->get();
       return view('backend.category.subcategory_view',compact('subcategories','categories'));

    }

    public function SubCategoryStore(Request $request)
    {    
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required|string|max:255',
            'subcategory_name_sin' => 'required|string|max:255',
            
        ],[
            'category_id.required' => 'Please Select Relevent Category',
            'subcategory_name_en.required' => 'Input SubCategory English Name',
            'subcategory_name_sin.required' => 'Input SubCategory Sinhala Name',
        ]);

        SubCategory::insert([

            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_sin' => $request->subcategory_name_sin,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_sin' => strtolower(str_replace(' ','-',$request->subcategory_name_sin)),
         ]);


         $notification = array(
           'message' => 'New SubCategory Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);

     }

     public function SubCategoryEdit($id){

        $subcategory = SubCategory::findorFail($id);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));

     }

     public function SubCategoryUpdate(Request $request){

        $subcategory_id = $request->id;

        SubCategory::findorFail($subcategory_id)->update([
            
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_sin' => $request->subcategory_name_sin,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_sin' => strtolower(str_replace(' ','-',$request->subcategory_name_sin)),
            
         ]);


         $notification = array(
           'message' => 'SubCategory Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.subcategory')->with($notification);


     }

     public function SubCategoryDelete($id){

        $subcategory = SubCategory::findorFail($id);

        $subsubcategory = SubSubCategory::where("subcategory_id","=",$subcategory->id)->delete();

        SubCategory::findorFail($id)->delete();

        $notification = array(
           'message' => 'SubCategory deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('all.subcategory')->with($notification);
     }
}
