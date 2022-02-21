<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView(){

       $subsubcategories = SubSubCategory::latest()->get();
       $categories = Category::orderBy('category_name_en','ASC')->get();
       return view('backend.category.subsubcategory_view',compact('subsubcategories','categories'));

    }

    public function subCategoryLoad($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();

        return json_encode($subcat);


    }

    public function SubSubCategoryStore(Request $request)
    {    
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required|string|max:255',
            'subsubcategory_name_sin' => 'required|string|max:255',
            
        ],[
            'category_id.required' => 'Please Select Relevent Category',
            'subsubcategory_name_en.required' => 'Input SubSubCategory English Name',
            'subsubcategory_name_sin.required' => 'Input SubSubCategory Sinhala Name',
        ]);

        SubSubCategory::insert([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_sin' => $request->subsubcategory_name_sin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_sin' => strtolower(str_replace(' ','-',$request->subsubcategory_name_sin)),
         ]);


         $notification = array(
           'message' => 'New Sub-SubCategory Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);

     }

    public function SubSubCategoryEdit($id){

        $subsubcategory = SubSubCategory::findorFail($id);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        return view('backend.category.subsubcategory_edit',compact('subsubcategory','categories','subcategories'));

     }

     public function SubSubCategoryUpdate(Request $request){

        $subsubcategory_id = $request->id;

        SubSubCategory::findorFail($subsubcategory_id)->update([
            
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_sin' => $request->subsubcategory_name_sin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_sin' => strtolower(str_replace(' ','-',$request->subsubcategory_name_sin)),
            
         ]);


         $notification = array(
           'message' => 'Sub-SubCategory Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);


     }

     public function SubSubCategoryDelete($id){

        $subsubcategory = SubSubCategory::findorFail($id);

        SubSubCategory::findorFail($id)->delete();

        $notification = array(
           'message' => 'Sub-SubCategory deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
     }
}
