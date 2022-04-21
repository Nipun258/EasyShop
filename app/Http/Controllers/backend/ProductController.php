<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function ProductAdd(){

       $categories = Category::latest()->get();
       $brands = Brand::latest()->get();
       return view('backend.product.product_add',compact('categories','brands'));

    }

    public function ProductStore(Request $request){

        $validatedData = $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required',
            'product_name_sin' => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_tags_en' => 'required',
            'product_tags_sin' => 'required',
            'product_color_en' => 'required',
            'product_color_sin' => 'required',
            'selling_price' => 'required',
            'product_thambnail' => 'required',
            'multi_img' => 'required',
            'short_descp_en' => 'required',
            'short_descp_sin' => 'required',
            'long_descp_en' => 'required',
            'long_descp_sin' => 'required',

        ],[
            'brand_id.required' => 'Please Select Relevent Product Brands',
            'category_id.required' => 'Please Select Relevent Product categories',
            'subcategory_id.required' => 'Please Select Relevent Product Sub categories',
            'subsubcategory_id.required' => 'Please Select Relevent Product Sub Sub categories',
        ]);

         $image = $request->file('product_thambnail');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
         $save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_sin' => $request->product_name_sin,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_sin' => strtolower(str_replace(' ','-',$request->product_name_sin)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_sin' => $request->product_tags_sin,
            'product_size_en' => $request->product_size_en,
            'product_size_sin' => $request->product_size_sin,
            'product_color_en' => $request->product_color_en,
            'product_color_sin' => $request->product_color_sin,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_sin' => $request->short_descp_sin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_sin' => $request->long_descp_sin,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        /****multiple image upload************/
        
        $images = $request->file('multi_img');
        foreach ($images as $img) {
         $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
         Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
         $upload_path = 'upload/products/multi-image/'.$make_name;

        MultiImg::insert([
            
            'product_id' => $product_id,
            'photo_name' => $upload_path,
            'created_at' => Carbon::now(),

        ]);

        }

        /****************************************************/

        $notification = array(
           'message' => 'New Category Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('manage.product')->with($notification);

    }

    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));
    }

    public function ProductEdit($id){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('categories','brands','subcategory','subsubcategory','products'));

    }

    public function ProductUpdate(Request $request){

        $product_id = $request->id;

         Product::findOrFail($product_id)->update([
        'brand_id' => $request->brand_id,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'subsubcategory_id' => $request->subsubcategory_id,
        'product_name_en' => $request->product_name_en,
        'product_name_sin' => $request->product_name_sin,
        'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
        'product_slug_sin' => str_replace(' ', '-', $request->product_name_sin),
        'product_code' => $request->product_code,

        'product_qty' => $request->product_qty,
        'product_tags_en' => $request->product_tags_en,
        'product_tags_sin' => $request->product_tags_sin,
        'product_size_en' => $request->product_size_en,
        'product_size_sin' => $request->product_size_sin,
        'product_color_en' => $request->product_color_en,
        'product_color_sin' => $request->product_color_sin,

        'selling_price' => $request->selling_price,
        'discount_price' => $request->discount_price,
        'short_descp_en' => $request->short_descp_en,
        'short_descp_sin' => $request->short_descp_sin,
        'long_descp_en' => $request->long_descp_en,
        'long_descp_sin' => $request->long_descp_sin,

        'hot_deals' => $request->hot_deals,
        'featured' => $request->featured,
        'special_offer' => $request->special_offer,
        'special_deals' => $request->special_deals,          
        'status' => 1,
        'created_at' => Carbon::now(), 

      ]);

          $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.product')->with($notification);


    } // end method 
}
