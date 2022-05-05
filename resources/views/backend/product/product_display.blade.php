@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title"> Product Summary View </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

    <input type="hidden" name="id" value="{{ $products->id }}">
					  <div class="row">
	<div class="col-12">	


		<div class="row"> <!-- start 1st row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5 class="text-white">Brand Name</h5>
	<div class="controls">
		<select name="brand_id" class="form-control" required="" disabled>
			<option value="" selected="" disabled="">Brand Select</option>
			@foreach($brands as $brand)
 <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected': '' }} >{{ $brand->brand_name_en }}</option>	
			@endforeach
		</select> 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
	<h5 class="text-white">Category Name </h5>
	<div class="controls">
		<select name="category_id" class="form-control" required="" disabled>
			<option value="" selected="" disabled="">Select Category</option>
			@foreach($categories as $category)
 <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected': '' }} >{{ $category->category_name_en }}</option>	
			@endforeach
		</select> 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
	<h5 class="text-white">SubCategory Name</h5>
	<div class="controls">
		<select name="subcategory_id" class="form-control" required=""  disabled>
			<option value="" selected="" disabled="">Select SubCategory</option>

			 @foreach($subcategory as $sub)
 <option value="{{ $sub->id }}" {{ $sub->id == $products->subcategory_id ? 'selected': '' }} >{{ $sub->subcategory_name_en }}</option>	
			@endforeach

		</select>
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 1st row  -->



<div class="row"> <!-- start 2nd row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5 class="text-white">SubSubCategory Name</h5>
	<div class="controls">
		<select name="subsubcategory_id" class="form-control" required="" disabled>
			<option value="" selected="" disabled="">Select SubSubCategory</option>

		 @foreach($subsubcategory as $subsub)
 <option value="{{ $subsub->id }}" {{ $subsub->id == $products->subsubcategory_id ? 'selected': '' }} >{{ $subsub->subsubcategory_name_en }}</option>	
			@endforeach

		</select>
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Name English</h5>
			<div class="controls">
				<input type="text" name="product_name_en" class="form-control" value="{{ $products->product_name_en}}" disabled>
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Name Sinhala</h5>
			<div class="controls">
				<input type="text" name="product_name_sin" class="form-control" value="{{ $products->product_name_sin}}" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 2nd row  -->



<div class="row"> <!-- start 3RD row  -->
			<div class="col-md-4">

	  <div class="form-group">
			<h5 class="text-white">Product Code </h5>
			<div class="controls">
				<input type="text" name="product_code" class="form-control" value="{{ $products->product_code }}" disabled>
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Quantity</h5>
			<div class="controls">
				<input type="text" name="product_qty" class="form-control" value="{{ $products->product_qty }}" disabled>
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Tags List</h5>
			<div class="controls">
	 <input type="text" name="product_tags_en" class="form-control" value="{{ $products->product_tags_en }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 3RD row  -->






<div class="row"> <!-- start 4th row  -->
			<div class="col-md-4">

	    <div class="form-group">
			<h5 class="text-white">Product Tags List(S)</h5>
			<div class="controls">
	 <input type="text" name="product_tags_sin" class="form-control" value="{{ $products->product_tags_sin }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Size List </h5>
			<div class="controls">
	 <input type="text" name="product_size_en" class="form-control"  value="{{ $products->product_size_en }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Size List(S) </h5>
			<div class="controls">
	 <input type="text" name="product_size_sin" class="form-control" value="{{ $products->product_size_sin }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 4th row  -->



<div class="row"> <!-- start 5th row  -->
			<div class="col-md-4">

	    <div class="form-group">
			<h5 class="text-white">Product Color List </h5>
			<div class="controls">
	 <input type="text" name="product_color_en" class="form-control" value="{{ $products->product_color_en }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5 class="text-white">Product Color Sin </h5>
			<div class="controls">
	 <input type="text" name="product_color_sin" class="form-control" value="{{ $products->product_color_sin }}" data-role="tagsinput" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				<div class="form-group">
			<h5 class="text-white">Product Selling Price </h5>
			<div class="controls">
				<input type="text" name="selling_price" class="form-control" value="Rs.{{ number_format($products->selling_price , 2)}}" disabled>
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 5th row  -->




<div class="row"> <!-- start 6th row  -->
			<div class="col-md-6">

	    <div class="form-group">
			<h5 class="text-white">Product Discount Price </h5>
			<div class="controls">
	 <input type="text" name="discount_price" class="form-control"  value="Rs.{{ number_format($products->discount_price , 2)}}" disabled>
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">


			</div> <!-- end col md 4 -->


			<div class="col-md-4">


			</div> <!-- end col md 4 -->

		</div> <!-- end 6th row  -->





<div class="row"> <!-- start 7th row  -->
			<div class="col-md-6">

	    <div class="form-group">
			<h5 class="text-white">Short Description English </h5>
			<div class="controls">
	<textarea name="short_descp_en" id="textarea" class="form-control"  disabled>{!! $products->short_descp_en !!}</textarea>     
	 		 </div>
		</div>

			</div> <!-- end col md 6 -->

			<div class="col-md-6">

	     <div class="form-group">
			<h5 class="text-white">Short Description Sinhala</h5>
			<div class="controls">
	<textarea name="short_descp_sin" id="textarea" class="form-control" disabled>{!! $products->short_descp_sin !!}</textarea>     
	 		 </div>
		</div>


			</div> <!-- end col md 6 -->		 

		</div> <!-- end 7th row  -->





<div class="row"> <!-- start 8th row  -->
			<div class="col-md-6">

	    <div class="form-group">
			<h5 class="text-white">Long Description English </h5>
			<div class="controls">
	<textarea id="editor1" name="long_descp_en" rows="10" cols="80" disabled>
		{!! $products->long_descp_en !!}
						</textarea>  
	 		 </div>
		</div>

			</div> <!-- end col md 6 -->

			<div class="col-md-6">

	     <div class="form-group">
			<h5 class="text-white">Long Description Sinhala</h5>
			<div class="controls">
	<textarea id="editor2" name="long_descp_sin" rows="10" cols="80" disabled>
		{!! $products->long_descp_sin !!}
						</textarea>       
	 		 </div>
		</div>


			</div> <!-- end col md 6 -->		 

		</div> <!-- end 8th row  -->


	 <hr>



	<div class="row">

<div class="col-md-6">
			<div class="form-group">

		<div class="controls">
			<fieldset>
				<input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked': '' }} disabled >
				<label for="checkbox_2" class="text-white">Hot Deals</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked': '' }} disabled>
				<label for="checkbox_3" class="text-white">Featured</label>
			</fieldset>
		</div>
	</div>
</div>



<div class="col-md-6">
	<div class="form-group">

		<div class="controls">
			<fieldset>
				<input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked': '' }} disabled>
				<label for="checkbox_4" class="text-white">Special Offer</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked': '' }} disabled>
				<label for="checkbox_5" class="text-white">Special Deals</label>
			</fieldset>
		</div>
			</div>
		</div>
						</div>


				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->

		<!-- ///////////////// Start Multiple Image Update Area ///////// -->

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
				<div class="box-header">
					<h4 class="box-title">Product Multiple Image List </h4>
				</div>
				
					<div class="row row-sm container">
						@foreach($multiImgs as $img)
						<div class="col-md-3">
							<div class="card border border-10">
								<img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 250px; width: 400px;">
								<div class="card-body center">
									<a href="" class="btn btn-primary">+</a>
								</div>
							</div>
							</div><!--  end col md 3		 -->
							@endforeach
						</div>

						<br><br>

				</div>
			</div>
			</div> <!-- // end row  -->
		</section>
		
<!-- ///////////////// Start Thambnail Image Update Area ///////// -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
				<div class="box-header">
					<h4 class="box-title">Product Thambnail Image </h4>
				</div>
					<input type="hidden" name="id" value="{{ $products->id }}">
					<input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">
					<div class="row row-sm container">
						<div class="col-md-3">
							<div class="card border border-10">
								<img src="{{ asset($products->product_thambnail) }}" class="card-img-top" style="height: 250px; width: 400px;">
								<div class="card-body">
						
								</div>
							</div>
							</div><!--  end col md 3		 -->
						</div>
						<br><br>
				</div>
			</div>
		</div>
		</div> <!-- // end row  -->
	</section>
	<!-- ///////////////// End Start Thambnail Image Update Area ///////// -->

	  </div>

 <script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                    	$('select[name="subsubcategory_id"]').html('');
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });

 $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subsubcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
 
    });
    </script>


<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>


<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>




@endsection 