@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
      <h1>My Profile<small>Edit</small></h1>
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/admin/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>
<!-- Main content --> 
	<section class="content">
			<div class="row">
				<div class="col-md-12">
					<!-- Flash Message Start -->
					<div class="server-error">
						@include('../Elements/flash-message')
					</div>
					<!-- Flash Message End -->
				</div>
			</div>	
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-success">
						 <div class="box-header with-border">
							<h3 class="box-title">My Profile</h3>
						</div> 
						<div class="card-body">
							{{ Form::open(array('url' => 'admin/my_profile', 'name'=>"my-profile", 'enctype'=>'multipart/form-data')) }}
								{{ Form::hidden('id', $fetchedData->id) }}
								<div class="box-body"> 
									<div class="col-sm-12">
										<div class="form-group profile_img_field">
											<label for="test_pdf">Profile Image Upload</label>
											<input type="hidden" id="old_profile_img" name="old_profile_img" value="{{@$fetchedData->profile_img}}" />
											<div class="show-uploded-img">	  
												@if(@Auth::user()->profile_img == '') 
													<img src="{{ asset('/public/img/avatars/default_profile.jpg') }}" class="img-avatar" />
												@else
													<img src="{{URL::to('/public/img/profile_imgs')}}/{{@Auth::user()->profile_img}}" class="img-avatar"/>
												@endif
												<div class="profile_input">
													<input type="file" name="profile_img" class="uploadImageFile" />
													
												</div> 
											</div>    
										</div>
									</div> 
									<div class="col-sm-6">
										<div class="form-group">
											@if(Auth::user()->role == 3)
												<label for="first_name">Organization Name <span style="color:#ff0000;">*</span></label>
											@else
												<label for="first_name">First Name <span style="color:#ff0000;">*</span></label>
											@endif	
											
												{{ Form::text('first_name', @$fetchedData->first_name, array('class' => 'form-control', 'data-valid'=>'required')) }}
										
											@if ($errors->has('first_name'))
												<span class="custom-error" role="alert">
													<strong>{{ $errors->first('first_name') }}</strong>
												</span>
											@endif
										</div>
									</div>
								@if(Auth::user()->role != 3)
									<div class="col-sm-6">
										<div class="form-group">
											<label for="last_name">Last Name <span style="color:#ff0000;">*</span></label>
												{{ Form::text('last_name', @$fetchedData->last_name, array('class' => 'form-control', 'data-valid'=>'required')) }}
										
											@if ($errors->has('last_name'))
												<span class="custom-error" role="alert">
													<strong>{{ $errors->first('last_name') }}</strong>
												</span>
											@endif
										</div>
									</div>
								@endif
								<div class="col-sm-6">
									<div class="form-group">
										<label for="email">Email <span style="color:#ff0000;">*</span></label>
											{{ Form::text('email', @$fetchedData->email, array('class' => 'form-control', 'data-valid'=>'required email')) }}
									
										@if ($errors->has('email'))
											<span class="custom-error" role="alert">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="phone">Phone <span style="color:#ff0000;">*</span></label>
											{{ Form::text('phone', @$fetchedData->phone, array('class' => 'form-control mask', 'data-valid'=>'required', 'placeholder'=>'000-000-0000')) }}
									
										@if ($errors->has('phone'))
											<span class="custom-error" role="alert">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="company_name">Company Name </label>
											{{ Form::text('company_name', @$fetchedData->company_name, array('class' => 'form-control mask', 'data-valid'=>'', 'placeholder'=>'Company Name')) }}
									
										@if ($errors->has('company_name'))
											<span class="custom-error" role="alert">
												<strong>{{ $errors->first('company_name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="company_website">Company Website </label>
											{{ Form::text('company_website', @$fetchedData->company_website, array('class' => 'form-control mask', 'data-valid'=>'', 'placeholder'=>'Company Website')) }}
									
										@if ($errors->has('company_website'))
											<span class="custom-error" role="alert">
												<strong>{{ $errors->first('company_website') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
																					
							</div>																
							<div class="box-footer">
								<button type="button" class="btn btn-default">Cancel</button>
								{{ Form::button('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-info pull-right', 'onClick'=>'customValidate("my-profile")']) }}
							</div>
							{{ Form::close() }}	 
						</div>
					</div>
				</div>
			</div>
	</section>
</div>
<script>
jQuery(document).ready(function($){
	$('#select_country').attr('data-selected-country','<?php echo @$fetchedData->country; ?>');
		$('#select_country').flagStrap();
});
</script>
@endsection