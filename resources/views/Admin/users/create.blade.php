@extends('layouts.admin')
@section('title', 'Create User')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/users/store', 'name'=>"add-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
								<input type="text" name="first_name" data-valid="required" class="form-control"/>
								@if ($errors->has('first_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('first_name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" name="last_name" data-valid="required" class="form-control"/>
								@if ($errors->has('last_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('last_name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="phone" data-valid="" class="form-control"/>
								@if ($errors->has('phone'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('phone') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Gender</label>
								<select class="form-control" name="gender">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
							
							<div class="form-group">
								<label>About Us</label>
								<textarea name="about_us" data-valid="" class="form-control"></textarea>
								
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
										<input type="text" name="username" data-valid="required" class="form-control"/>
										@if ($errors->has('username'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('username') }}</strong>
											</span> 
										@endif
									</div>
								<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" data-valid="required email" class="form-control"/>
										@if ($errors->has('email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('email') }}</strong>
											</span> 
										@endif
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" data-valid="required" class="form-control"/>
										@if ($errors->has('password'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('password') }}</strong>
											</span> 
										@endif
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" name="password_confirmation" data-valid="required" class="form-control"/>
										
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
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('add-company')" class="btn btn-success pull-right">Submit</button>
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