@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Admin Profile Edit</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">

								@csrf
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<h5>Admin User Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="name" class="form-control" value="{{ $editData->name}}"> 
														<div class="help-block"></div></div>
													</div>
												</div>
											<div class="col-md-6">
												<div class="form-group">
													<h5>Admin Email<span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="email" name="email" class="form-control" value="{{ $editData->email}}"> 
														<div class="help-block"></div></div>
													</div>
												</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<h5>Profile Image<span class="text-danger">*</span></h5>
															<div class="controls">
																<input type="file" class="form-control" name="profile_photo_path" id="profile_photo_path"> 
																<div class="help-block"></div>
															</div>
															</div>
													  </div>
													  <div class="col-md-6">
													  	<div class="form-group">
		<div class="controls">
	<img id="showImage" src="{{ (!empty($editData->profile_photo_path))? url('upload/admin_images/'.$editData->profile_photo_path):url('upload/images.png')}}" style="width: 100px; width: 100px; border: 1px solid #000000;">
													  </div>
												</div>
												</div>
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-primary mb-5" value="update">
												</div>
											</form>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.box-body -->
							</div>
						</div>
					</section>
					<!-- /.content -->
				</div>
				<script type="text/javascript">
	              $(document).ready(function(){
		           $('#profile_photo_path').change(function(e){
			        var reader = new FileReader();
			            reader.onload = function(e){
				       $('#showImage').attr('src',e.target.result);
			          }
		      	reader.readAsDataURL(e.target.files['0']);
		        });
	           });
				</script>
				@endsection
