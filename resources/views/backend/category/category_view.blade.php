@extends('admin.admin_master')
@section('admin')
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
				  <h3 class="box-title">Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td>Category Icon</td>
								<td>Category En</td>
								<td>Category Sin</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td><span><i class="{{ $category->category_icon}}"></i></span></td>
								<td>{{$category->category_name_en}}</td>
								<td>{{$category->category_name_sin}}</td>
								<td>
									<a href="{{ route('category.edit',$category->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('category.delete',$category->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add New Category </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<h5>Category Name English <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="category_name_en" id="category_name_en" class="form-control" >
					@error('category_name_en')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			<div class="form-group">
				<h5>Category Name Sinhala <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="category_name_sin" id="category_name_sin" class="form-control"  >
					@error('category_name_sin')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			<div class="form-group">
				<h5>Category Icon<span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="category_icon" id="category_icon" class="form-control" >
					@error('category_icon')
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
@endsection