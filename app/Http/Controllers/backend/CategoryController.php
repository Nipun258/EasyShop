<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function CategoryView(){

       $categories = Category::latest()->get();
       return view('backend.category.category_view',compact('categories'));

    }

    public function CategoryStore(Request $request)
    {    
        $validatedData = $request->validate([
            'category_name_en' => 'required|string|max:255',
            'category_name_sin' => 'required|string|max:255',
            'category_icon' => 'required'
        ],[
            'category_name_en.required' => 'Input Category English Name',
            'category_name_sin.required' => 'Input Category Sinhala Name',
        ]);

        Category::insert([

            'category_name_en' => $request->category_name_en,
            'category_name_sin' => $request->category_name_sin,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_sin' => strtolower(str_replace(' ','-',$request->category_name_sin)),
            'category_icon' => $request->category_icon,
         ]);


         $notification = array(
           'message' => 'New Category Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

     }

     public function CategoryEdit($id){

        $category = Category::findorFail($id);
        return view('backend.category.category_edit',compact('category'));
     }

     public function CategoryUpdate(Request $request){

        $category_id = $request->id;

        Category::findorFail($category_id)->update([

            'category_name_en' => $request->category_name_en,
            'category_name_sin' => $request->category_name_sin,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_sin' => strtolower(str_replace(' ','-',$request->category_name_sin)),
            'category_icon' => $request->category_icon
         ]);


         $notification = array(
           'message' => 'Category Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.category')->with($notification);


     }

     public function CategoryDelete($id){

        $category = Category::findorFail($id);

        $subcategory = SubCategory::where("category_id","=",$category->id)->delete();

        $subsubcategory = SubSubCategory::where("category_id","=",$category->id)->delete();

        Category::findorFail($id)->delete();

        $notification = array(
           'message' => 'Category deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('all.category')->with($notification);
     }

}
