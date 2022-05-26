@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/users/edit', 'name'=>"edit-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			{{ Form::hidden('id', @$fetchedData->id) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>User Info</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>First Name</label>
								<input value="<?php echo @$fetchedData->first_name; ?>" type="text" name="first_name" data-valid="required" class="form-control"/>
								@if ($errors->has('first_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('first_name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input value="<?php echo @$fetchedData->last_name; ?>" type="text" name="last_name" data-valid="required" class="form-control"/>
								@if ($errors->has('last_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('last_name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Gender</label>
								<select class="form-control" name="gender">
									<option value="Male" @if(@$fetchedData->gender == 'Male') selected  @endif>Male</option>
									<option value="Female" @if(@$fetchedData->gender == 'Female') selected  @endif>Female</option>
								</select>
							</div>
							
							<div class="form-group">
								<label>About Us</label>
								<textarea name="about_us" data-valid="" class="form-control"><?php echo @$fetchedData->about_us; ?></textarea>
								
							</div>
							
							
						</div>
					</div>
					
					<div class="card">
						<div class="card-header"> 
							<h4>Account Setting</h4>
						</div> 
						<div class="card-body"> 
							<div class="row">
							<div class="col-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label>Username</label>
										<input type="text" value="<?php echo @$fetchedData->username; ?>" name="username" data-valid="required" class="form-control"/>
										@if ($errors->has('username'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('username') }}</strong>
											</span> 
										@endif
									</div>
								<div class="form-group">
										<label>Email</label>
										<input type="email" value="<?php echo @$fetchedData->email; ?>" name="email" data-valid="required email" class="form-control"/>
										@if ($errors->has('email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('email') }}</strong>
											</span> 
										@endif
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" value="" name="password" data-valid="required" class="form-control"/>
										@if ($errors->has('password'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('password') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								
							</div>
						
						</div>
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
					<div class="card">
						<div class="card-header"> 
							<h4>Publish</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" @if(@$fetchedData->status == 1) selected  @endif>Publish</option>
									<option value="0" @if(@$fetchedData->status == 0) selected  @endif>Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('edit-company')" class="btn btn-success pull-right">Update</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Image</label>
								<input type="file" name="profile_img" class="form-control" />
								<input type="hidden" name="old_profile_img" value="<?php echo @$fetchedData->profile_img; ?>">
								<?php if($fetchedData->profile_img != ''){ ?>
								
								<img src="{{URL::to('/public/img/profile_imgs')}}/{{$fetchedData->profile_img}}" width="100" height="100">
								<?php } ?>
							</div>
						</div> 
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection