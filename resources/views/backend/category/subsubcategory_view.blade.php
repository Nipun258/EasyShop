@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <div class="container-full">
		<!-- Content Header (Page header) -->
<!-- 		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Data Tables</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Data Tables</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div> -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
 
			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub-SubCategory List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td>Category</td>
								<td>Sub Category</td>
								<td>SubSubCategory En</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($subsubcategories as $subsubcategory)
							<tr>
								<td>{{$subsubcategory['category']['category_name_en']}}</td>
								<td>{{$subsubcategory['subcategory']['subcategory_name_en']}}</td>
								<td>{{$subsubcategory->subsubcategory_name_en}}</td>
								<td width="30%">
									<a href="{{ route('subsubcategory.edit',$subsubcategory->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('subsubcategory.delete',$subsubcategory->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div>
			<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add New Sub-SubCategory </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{ route('subsubcategory.store') }}" >
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<h5>Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="category_id" id="category_id">
					<option value="" selected="" disabled="">Select Category Name</option>
				   @foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
				    @endforeach
				</select>
				@error('category_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>Sub Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="subcategory_id" id="subcategory_id">
					<option value="" selected="" disabled="">Select Sub Category Name</option>
				</select>
				@error('subcategory_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>SubCategory Name English <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="subsubcategory_name_en" id="subsubcategory_name_en" class="form-control" >
					@error('subsubcategory_name_en')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			<div class="form-group">
				<h5>SubCategory Name Sinhala <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="subsubcategory_name_sin" id="subsubcategory_name_sin" class="form-control"  >
					@error('subsubcategory_name_sin')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			<div class="text-xs-right">
				<input type="submit" class="btn btn-rounded btn-primary btn-info mb-5" value="Add New">
			</div>
		</form>
					
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div> 
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
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
    });
    </script>
@endsection