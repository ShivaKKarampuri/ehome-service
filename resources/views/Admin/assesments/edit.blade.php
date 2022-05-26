@extends('layouts.admin')
@section('title', 'Edit Customer')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Customer</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Customer</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->	
	<!-- Breadcrumb start-->
	<!--<ol class="breadcrumb">
		<li class="breadcrumb-item active">
			Home / <b>Dashboard</b>
		</li>
		@include('../Elements/Admin/breadcrumb')
	</ol>-->
	<!-- Breadcrumb end-->
	
	<!-- Main content --> 
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Flash Message Start -->
					<div class="server-error">
						@include('../Elements/flash-message')
					</div>
					<!-- Flash Message End -->
				</div>
			</div>
			<!-- form start -->
			{{ Form::open(array('url' => 'admin/hire-customer/edit', 'name'=>"edit-member", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			{{ Form::hidden('id', @$fetchedData->id) }}
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Edit Customer</h3>
							</div>
						  <!-- /.card-header -->  
							<div class="card-body">
								<div class="form-group" style="text-align:right;">
									<a style="margin-right:5px;" href="{{route('admin.hirecustomer.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
									{{ Form::button('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("edit-member")' ]) }}
								</div>
								<div class="row">  
									<div class="col-sm-2">
										<div class="form-group">  
											<label for="title" class="col-form-label">Title <span style="color:#ff0000;">*</span></label>
											<select name="title" data-valid="required" class="form-control">
												<option value="MR" @if($fetchedData->title == 'MR') selected @endif>MR</option>
												<option value="MRS" @if($fetchedData->title == 'MRS') selected @endif>MRS</option>
												<option value="MS" @if($fetchedData->title == 'MS') selected @endif>MS</option>
											</select>
										</div>
									</div>
									<div class="col-sm-10">  
										<div class="form-group">  
											<label for="owner_name" class="col-form-label">Owner's Name <span style="color:#ff0000;">*</span></label>
											{{ Form::text('owner_name', @$fetchedData->owner_name, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Owner Name *' )) }}
											@if ($errors->has('owner_name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('owner_name') }}</strong>
												</span> 
											@endif
										</div>
									</div>
										
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Owner's Email <span style="color:#ff0000;">*</span></label>
											{{ Form::text('email', @$fetchedData->email, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Owner Email *' )) }}
											@if ($errors->has('email'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('email') }}</strong>
												</span> 
											@endif
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="birth_date" class="col-form-label">Date of Birth</label>
											<div class="date_field" style="position:relative;"> 
												{{ Form::text('birth_date', @$fetchedData->birth_date, array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Date of Birth' )) }}
												<div class="calendar_icon"><i class="fa fa-calendar"></i></div>
											</div>
											@if ($errors->has('birth_date'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('birth_date') }}</strong>
												</span> 
											@endif
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="phone" class="col-form-label">Owner's Contact Details <span style="color:#ff0000;">*</span></label>
											{{ Form::text('phone', @$fetchedData->phone, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Mobile Phone *' )) }}
											@if ($errors->has('phone'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('phone') }}</strong>
												</span> 
											@endif
										</div> 
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="home_contact" class="col-form-label"></label>
											{{ Form::text('home_contact', @$fetchedData->home_contact, array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Home Contact' )) }}
											@if ($errors->has('home_contact'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('home_contact') }}</strong>
												</span> 
											@endif
										</div> 
									</div>
									
								
									<div class="col-sm-6">
										<div class="form-group">
											<label for="address" class="col-form-label">Address</label>
											<textarea data-valid="required" name="address" class="form-control" placeholder="Address" style="width: 100%; height:80px;padding: 10px;margin-bottom:10px;">{{@$fetchedData->address}}</textarea>
											@if ($errors->has('address'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('address') }}</strong>
												</span> 
											@endif
										</div>  
									</div> 
									<div class="col-sm-6">    
										<div class="form-group row">   
											<label for="gst" class="col-sm-3 col-form-label">GST</label>
											<div class="col-sm-9">
												<div class="form-check form-check-inline">
													<input type="radio" class="form-check-input" @if($fetchedData->gst == '1') checked @endif value="1" name="gst" id="gst_yes" /><label class="form-check-label" for="gst_yes">Yes</label>
												</div>
												<div class="form-check form-check-inline">
													<input type="radio" @if($fetchedData->gst == '0') checked @endif class="form-check-input" value="0" name="gst" id="gst_no" />
													<label class="form-check-label" for="gst_no">No</label>
												</div>
												<div @if($fetchedData->gst == '0') style="display:none;" @endif class="form-check form-check-inline is_gst abn_label">
													<label class="form-check-label" for="abn">ABN</label>
													<input type="text" class="form-control" value="{{@$fetchedData->abn}}" name="abn" id="abn" />
												</div>
											</div> 
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="license" class="col-form-label">License Number</label>
											<input data-valid="required" type="text" name="license" class="form-control" placeholder="License Number" value="{{@$fetchedData->license}}" >
											@if ($errors->has('license'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('license') }}</strong>
												</span> 
											@endif
										</div>  
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="license_expire" class="col-form-label">License Expiry Date</label>
											<input data-valid="required" type="text" name="license_expire" class="form-control commodate" placeholder="License Expiry Date" value="{{@$fetchedData->license_expire}}"> 
											@if ($errors->has('license_expire'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('license_expire') }}</strong>
												</span> 
											@endif
										</div>  
									</div>  
								</div> 
								<div class="row">	
									<div class="col-md-12">  
										<div style="margin-bottom:0px;" class="float-right form-group">
											{{ Form::button('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("edit-member")' ]) }}
										</div>
									</div>	
								</div>
							</div> 
						</div>	
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
<script>
jQuery(document).ready(function($){
	$('input[name="gst"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_gst').show();
			$('#abn').attr('data-valid','required');
		}else{
			$('.is_gst').hide();
			$('#abn').attr('data-valid','');
		}
	});
});
</script>
@endsection