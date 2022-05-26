@extends('layouts.admin')
@section('title', 'Create Company')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/company/store', 'name'=>"add-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Company Info</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>Company Name</label>
								<input type="text" name="company_name" data-valid="required" class="form-control"/>
								@if ($errors->has('company_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('company_name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Company Email</label>
								<input type="text" name="email" data-valid="required email" class="form-control"/>
								@if ($errors->has('email'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('email') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Company Phone No.</label>
								<input type="text" name="phone" data-valid="required" class="form-control"/>
								@if ($errors->has('phone'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('phone') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Company Website</label>
								<input type="text" name="company_website" class="form-control"/>
								@if ($errors->has('company_website'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('company_website') }}</strong>
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
							
						</div>
					</div>
					
					<div class="card">
						<div class="card-header"> 
							<h4>Personal Details</h4>
						</div> 
						<div class="card-body"> 
							<div class="row">
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="first_name" data-valid="required" class="form-control"/>
										@if ($errors->has('first_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('first_name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" data-valid="required" class="form-control"/>
										@if ($errors->has('last_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('last_name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class="form-control"/>
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