@extends('layouts.admin')
@section('title', 'Edit Vehicle')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Vehicle</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Vehicle</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->	
	
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
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Edit Vehicle</h3>
						</div>
					  <!-- /.card-header -->
						<div class="card-body">
							<!-- form start -->
						{{ Form::open(array('url' => 'admin/vehicle/edit', 'name'=>"add-claim", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
						<input type="hidden" name="id" value="{{@$fetchedData->id}}">
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="{{route('admin.vehicle.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
								{{ Form::button('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("add-claim")' ]) }}
							</div> 	 
							<div class="row"> 
								<div class="col-sm-12">    
									<div class="form-group row">  
										<label for="customer_name" class="col-sm-3 col-form-label">Member Name <span style="color:#ff0000;">*</span></label>
										<div class="col-sm-9">
											<select id="customer_name" name="customer_name" data-valid="required" class="form-control select2bs4" style="width: 100%;">
												<option value="">Select Member</option>
												@foreach(\App\Member::all() as $clist)
													<option value="{{@$clist->id}}" @if(@$fetchedData->customer_id == $clist->id) selected @endif>{{@$clist->title}} {{@$clist->owner_name}}</option>
												@endforeach
											</select>
											
										</div>
										@if ($errors->has('customer_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('customer_name') }}</strong>
											</span> 
										@endif
									</div>  
								</div>
							</div>
							<div class="row" style="margin-top: 25px;">
								<div class="col-sm-12">
									<div class="addresslist" style="display:none;">
										
									</div>
								</div>
							</div>
							<div class="row"> 
								<div class="col-sm-6">    
									<div class="form-group">   
										<label for="makemodal" class="col-form-label">Year, Make & Modal</label>
										{{ Form::text('makemodal', @$fetchedData->model, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Year, Make & Modal' )) }}
										@if ($errors->has('makemodal'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('makemodal') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group">   
										<label for="veh_reg" class="col-form-label">Vehicle Registration</label>
										{{ Form::text('veh_reg', @$fetchedData->vehicle_registration, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Vehicle Registration' )) }}
										@if ($errors->has('veh_reg'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('veh_reg') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group">   
										<label for="vin_no" class="col-form-label">VIN Number</label>
										{{ Form::text('vin_no', @$fetchedData->vin_number, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'VIN Number' )) }}
										@if ($errors->has('vin_no'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('vin_no') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">										
									<div class="form-group">
										<label for="excess" class="col-form-label">Excess</label>
										{{ Form::text('excess', @$fetchedData->excess, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Excess' )) }}
										@if ($errors->has('excess'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('excess') }}</strong>
											</span> 
										@endif
 									</div>
								</div>
								<div class="col-sm-6">										
									<div class="form-group">
										<label for="vehicle_type" class="col-form-label">Vehicle Type</label>
										<select id="vehicle_type" name="vehicle_type" data-valid="required" class="form-control" style="width: 100%;">
											<option value="">-- Vehicle Type --</option>
											<option value="Ride Share" @if(@$fetchedData->vehicle_type == "Ride Share") selected @endif>Ride Share</option>
											<option value="Uber" @if(@$fetchedData->vehicle_type == "Uber") selected @endif>Uber</option>
											<option value="Taxi" @if(@$fetchedData->vehicle_type == "Taxi") selected @endif>Taxi</option>
										</select>
										@if ($errors->has('vehicle_type'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('vehicle_type') }}</strong>
											</span> 
										@endif
 									</div>
								</div>
								<div class="col-sm-6">										
									<div class="form-group">
										<label for="joining_date" class="col-form-label">Joining Date</label>
										{{ Form::text('joining_date', @$fetchedData->joining_date, array('class' => 'form-control commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Joining Date' )) }}
										@if ($errors->has('joining_date'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('joining_date') }}</strong>
											</span> 
										@endif
 									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_one" class="col-form-label">Image 1</label>
										<input type="file" name="licence_one" >
										<?php if($fetchedData->licence_one != ''){ ?>
											<input type="hidden" name="old_licence_one" value="<?php echo @$fetchedData->licence_one; ?>">
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_one}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_two" class="col-form-label">Image 2</label>
										<input type="file" name="licence_two" >
										<?php if($fetchedData->licence_two != ''){ ?>
											<input type="hidden" name="old_licence_two" value="<?php echo @$fetchedData->licence_two; ?>">
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_two}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_three" class="col-form-label">Image 3</label>
										<input type="file" name="licence_three" >
										<?php if($fetchedData->licence_three != ''){ ?>
											<input type="hidden" name="old_licence_three" value="<?php echo @$fetchedData->licence_three; ?>">
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_three}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
									</div>
								</div> 
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_four" class="col-form-label">Image 4</label>
										<input type="file" name="licence_four" >
										<?php if($fetchedData->licence_four != ''){ ?>
											<input type="hidden" name="old_licence_four" value="<?php echo @$fetchedData->licence_four; ?>">
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_four}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="vic_certificate" class="col-form-label">Vic Road Certificate</label>
										<input type="file" name="vic_certificate" >
										<?php if($fetchedData->vic_certificate != ''){ ?>
											<input type="hidden" name="old_vic_certificate" value="<?php echo @$fetchedData->vic_certificate; ?>">
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->vic_certificate}}"><img src="{{URL::to('/public/img')}}/certificate.png" width="100" height="100"></a>
										<?php } ?>
									</div>
								</div>
							</div>
							
							<input id="save_type" name="save_type" type="hidden" value="save_send">
							<div class="form-group" style="text-align:right;">
								{{ Form::button('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("add-claim")' ]) }}
								<button type="button" class="btn btn-default cancel_btn">Cancel</button>
							</div>
							{{ Form::close() }}   
						</div> 
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>
@endsection