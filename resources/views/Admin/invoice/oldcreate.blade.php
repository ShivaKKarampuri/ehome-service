@extends('layouts.admin')
@section('title', 'Car Cover')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Car Cover</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Car Cover</li>
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
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Car Cover</h3>
						</div>
					  <!-- /.card-header -->
						<div class="card-body">
							<!-- form start -->
						{{ Form::open(array('url' => 'admin/carcover/store', 'name'=>"add-carcover", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="{{route('admin.invoice.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
								{{ Form::button('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("add-carcover")' ]) }}
							</div> 	 
							<div class="row"> 
								<div class="col-sm-6">    
									<div class="form-group row">  
										<label for="repairer" class="col-sm-3 col-form-label">Repairer</label>
										<div class="col-sm-9">
											{{ Form::text('repairer', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Repairer' )) }}
											@if ($errors->has('repairer'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('repairer') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div> 
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="phone" class="col-sm-3 col-form-label">Phone</label>
										<div class="col-sm-9">
											{{ Form::text('phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Phone' )) }}
											@if ($errors->has('phone'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('phone') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div> 	
								<div class="col-sm-12">
									<div class="cus_form_heading">
										<h4>Your Vehicle Details</h4>
									</div>
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="makemodal" class="col-sm-3 col-form-label">Year, Make & Modal</label>
										<div class="col-sm-9">
											{{ Form::text('makemodal', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Year, Make & Modal' )) }}
											@if ($errors->has('makemodal'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('makemodal') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="veh_reg" class="col-sm-3 col-form-label">Vehicle Registration</label>
										<div class="col-sm-9">
											{{ Form::text('veh_reg', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Vehicle Registration' )) }}
											@if ($errors->has('veh_reg'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('veh_reg') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="insured" class="col-sm-3 col-form-label">Insured</label>
										<div class="col-sm-9">
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="yes" /><label class="form-check-label" for="yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="no" />
												<label class="form-check-label" for="no">No</label>
											</div>
											@if ($errors->has('insured'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('insured') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="third_party" class="col-sm-3 col-form-label">Comprehensive/Third Party</label>
										<div class="col-sm-9">
											{{ Form::text('third_party', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Comprehensive/Third Party' )) }}
											@if ($errors->has('third_party'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('third_party') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="company_claim" class="col-sm-3 col-form-label">Company/Claim/Policy Number</label>
										<div class="col-sm-9">
											{{ Form::text('company_claim', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Company/Claim/Policy Number' )) }}
											@if ($errors->has('company_claim'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('company_claim') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								 
								
								
								
								
								<div class="col-sm-12">										
									<div class="form-group row"> 
										<label for="driver_name" class="col-sm-3 col-form-label">Driver's Name</label>
										<div class="col-sm-9 srname_field"> 
											<select name="driver_srname" class="form-control">
												<option>MR</option>
												<option>MRS</option>
												<option>MS</option>
											</select>
											{{ Form::text('driver_name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Driver Name' )) }}
											@if ($errors->has('driver_name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('driver_name') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="driver_contact" class="col-sm-3 col-form-label">Driver's Contact Details</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-6">
													{{ Form::text('driver_phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Home Contact' )) }}
													@if ($errors->has('driver_phone'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('driver_phone') }}</strong>
														</span> 
													@endif
												</div>
												<div class="col-sm-6">
													{{ Form::text('driver_mobile', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Mobile' )) }}
													@if ($errors->has('driver_mobile'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('driver_mobile') }}</strong>
														</span> 
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="driver_email" class="col-sm-3 col-form-label">Driver's Email</label>
										<div class="col-sm-9">
										{{ Form::text('driver_email', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Driver Email' )) }}
										@if ($errors->has('driver_email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('driver_email') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="cus_form_heading">
										<h4>Offending Vehicle Details</h4>
									</div>
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="makemodal" class="col-sm-3 col-form-label">Year, Make & Modal</label>
										<div class="col-sm-9">
											{{ Form::text('makemodal', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Year, Make & Modal' )) }}
											@if ($errors->has('makemodal'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('makemodal') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="veh_reg" class="col-sm-3 col-form-label">Vehicle Registration</label>
										<div class="col-sm-9">
											{{ Form::text('veh_reg', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Vehicle Registration' )) }}
											@if ($errors->has('veh_reg'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('veh_reg') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="insured" class="col-sm-3 col-form-label">Insured</label>
										<div class="col-sm-9">
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="yes" /><label class="form-check-label" for="yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="no" />
												<label class="form-check-label" for="no">No</label>
											</div>
											@if ($errors->has('insured'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('insured') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="third_party" class="col-sm-3 col-form-label">Comprehensive/Third Party</label>
										<div class="col-sm-9">
											{{ Form::text('third_party', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Comprehensive/Third Party' )) }}
											@if ($errors->has('third_party'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('third_party') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="company_claim" class="col-sm-3 col-form-label">Company/Claim/Policy Number</label>
										<div class="col-sm-9">
											{{ Form::text('company_claim', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Company/Claim/Policy Number' )) }}
											@if ($errors->has('company_claim'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('company_claim') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="owner_name" class="col-sm-3 col-form-label">Owner's Name</label>
										<div class="col-sm-9 srname_field">
											<select name="owner_srname" class="form-control">
												<option>MR</option>
												<option>MRS</option>
												<option>MS</option>
											</select>
											{{ Form::text('owner_name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Owners Name' )) }}
											@if ($errors->has('owner_name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('owner_name') }}</strong>
												</span> 
											@endif
										</div>
									</div> 
								</div> 
								<div class="col-sm-6">										
									<div class="form-group row">
										<label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
										<div class="col-sm-9">
										{{ Form::text('dob', '', array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Date of Birth' )) }}
										@if ($errors->has('dob'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('dob') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">										
									<div class="form-group row">
										<label for="license_no" class="col-sm-3 col-form-label">License Number</label>
										<div class="col-sm-9">
										{{ Form::text('license_no', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'License Number' )) }}
										@if ($errors->has('license_no'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('license_no') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">										
									<div class="form-group row">
										<label for="license_expire" class="col-sm-3 col-form-label">License Expiry Date</label>
										<div class="col-sm-9">
										{{ Form::text('license_expire', '', array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'License Expiry Date' )) }}
										@if ($errors->has('license_expire'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('license_expire') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="owner_address" class="col-sm-3 col-form-label">Owner's Address</label>
										<div class="col-sm-9">
										{{ Form::text('owner_address', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Owner Address' )) }}
										@if ($errors->has('owner_address'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('owner_address') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="owner_contact" class="col-sm-3 col-form-label">Owner's Contact Details</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-6">
													{{ Form::text('owner_home_phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Home Contact' )) }}
													@if ($errors->has('owner_home_phone'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('owner_home_phone') }}</strong>
														</span> 
													@endif
												</div>
												<div class="col-sm-6">
													{{ Form::text('owner_mobile', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Mobile' )) }}
													@if ($errors->has('owner_mobile'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('owner_mobile') }}</strong>
														</span> 
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="owner_email" class="col-sm-3 col-form-label">Owner's Email</label>
										<div class="col-sm-9">
										{{ Form::text('owner_email', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Owner Email' )) }}
										@if ($errors->has('owner_email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('owner_email') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="gst" class="col-sm-3 col-form-label">GST</label>
										<div class="col-sm-9">
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="gst" id="gst_yes" /><label class="form-check-label" for="gst_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="gst" id="gst_no" />
												<label class="form-check-label" for="gst_no">No</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="gst" id="abn" />
												<label class="form-check-label" for="abn">ABN</label>
											</div>
											<div class="form-check form-check-inline" style="vertical-align: top;">
												<input type="text" class="form-control" name="gst" id="gst" />
												<label class="form-check-label" for=""></label>
											</div>
											@if ($errors->has('gst'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('gst') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="driver_name" class="col-sm-3 col-form-label">Driver's Name</label>
										<div class="col-sm-9 srname_field"> 
											<select name="driver_srname" class="form-control">
												<option>MR</option>
												<option>MRS</option>
												<option>MS</option>
											</select>
											{{ Form::text('driver_name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Driver Name' )) }}
											@if ($errors->has('driver_name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('driver_name') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="driver_contact" class="col-sm-3 col-form-label">Driver's Contact Details</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-6">
													{{ Form::text('driver_phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Home Contact' )) }}
													@if ($errors->has('driver_phone'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('driver_phone') }}</strong>
														</span> 
													@endif
												</div>
												<div class="col-sm-6">
													{{ Form::text('driver_mobile', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Mobile' )) }}
													@if ($errors->has('driver_mobile'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('driver_mobile') }}</strong>
														</span> 
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="driver_email" class="col-sm-3 col-form-label">Driver's Email</label>
										<div class="col-sm-9">
										{{ Form::text('driver_email', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Driver Email' )) }}
										@if ($errors->has('driver_email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('driver_email') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="passengers_detail" class="col-sm-3 col-form-label">Passengers Details</label>
										<div class="col-sm-9">
										{{ Form::text('passengers_detail', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Passengers Details' )) }}
										@if ($errors->has('passengers_detail'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('passengers_detail') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="cus_form_heading">
										<h4>Third Vehicle Or Witness Details</h4>
									</div>
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="makemodal" class="col-sm-3 col-form-label">Year, Make & Modal</label>
										<div class="col-sm-9">
											{{ Form::text('makemodal', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Year, Make & Modal' )) }}
											@if ($errors->has('makemodal'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('makemodal') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="veh_reg" class="col-sm-3 col-form-label">Vehicle Registration</label>
										<div class="col-sm-9">
											{{ Form::text('veh_reg', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Vehicle Registration' )) }}
											@if ($errors->has('veh_reg'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('veh_reg') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="insured" class="col-sm-3 col-form-label">Insured</label>
										<div class="col-sm-9">
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="yes" /><label class="form-check-label" for="yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="insured" id="no" />
												<label class="form-check-label" for="no">No</label>
											</div>
											@if ($errors->has('insured'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('insured') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="third_party" class="col-sm-3 col-form-label">Comprehensive/Third Party</label>
										<div class="col-sm-9">
											{{ Form::text('third_party', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Comprehensive/Third Party' )) }}
											@if ($errors->has('third_party'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('third_party') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="company_claim" class="col-sm-3 col-form-label">Company/Claim/Policy Number</label>
										<div class="col-sm-9">
											{{ Form::text('company_claim', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Company/Claim/Policy Number' )) }}
											@if ($errors->has('company_claim'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('company_claim') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="name" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9 srname_field">
											<select name="srname" class="form-control">
												<option>MR</option>
												<option>MRS</option>
												<option>MS</option>
											</select>
											{{ Form::text('name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Name' )) }}
											@if ($errors->has('name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('name') }}</strong>
												</span> 
											@endif
										</div>
									</div> 
								</div> 
								<div class="col-sm-6">										
									<div class="form-group row">
										<label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
										<div class="col-sm-9">
										{{ Form::text('dob', '', array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Date of Birth' )) }}
										@if ($errors->has('dob'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('dob') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="address" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
										{{ Form::text('address', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Address' )) }}
										@if ($errors->has('address'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('address') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="contact_detail" class="col-sm-3 col-form-label">Contact Details</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-6">
													{{ Form::text('home_phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Home Contact' )) }}
													@if ($errors->has('home_phone'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('home_phone') }}</strong>
														</span> 
													@endif
												</div>
												<div class="col-sm-6">
													{{ Form::text('mobile', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Mobile' )) }}
													@if ($errors->has('mobile'))
														<span class="custom-error" role="alert">
															<strong>{{ @$errors->first('mobile') }}</strong>
														</span> 
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">										
									<div class="form-group row">
										<label for="email" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
										{{ Form::text('email', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Email' )) }}
										@if ($errors->has('email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('email') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="cus_form_heading">
										<h4>Accident Details</h4>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="accident_date" class="col-sm-3 col-form-label">Date</label>
										<div class="col-sm-9">
										{{ Form::text('accident_date', '', array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Date' )) }}
										@if ($errors->has('accident_date'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('accident_date') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="accident_time" class="col-sm-3 col-form-label">Time</label>
										<div class="col-sm-9">
										{{ Form::text('accident_time', '', array('class' => 'form-control commodate', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Time' )) }}
										@if ($errors->has('accident_time'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('accident_time') }}</strong>
											</span> 
										@endif
										</div>
									</div> 
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="loc_accident" class="col-sm-3 col-form-label">Location of Accident</label>
										<div class="col-sm-9">
											{{ Form::text('loc_accident', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Location of Accident' )) }}
											@if ($errors->has('loc_accident'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('loc_accident') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="desc_accident" class="col-sm-3 col-form-label">Description of Accident</label>
										<div class="col-sm-9">
											<textarea class="form-control" name="desc_accident" placeholder="Description of Accident"></textarea>
											@if ($errors->has('desc_accident'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('desc_accident') }}</strong>
												</span> 
											@endif
										</div>
									</div> 
								</div>
								<div class="col-sm-12">    
									<div class="form-group row">   
										<label for="report_matter" class="col-sm-3 col-form-label">Was the Matter Reported to the Police</label>
										<div class="col-sm-9">
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="report_matter" id="report_yes" /><label class="form-check-label" for="report_yes">Yes</label>
											</div> 
											<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="report_matter" id="report_no" />
												<label class="form-check-label" for="report_no">No</label>
											</div>
											@if ($errors->has('report_matter'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('report_matter') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="police_station" class="col-sm-3 col-form-label">Police Station</label>
										<div class="col-sm-9">
										{{ Form::text('police_station', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Police Station' )) }}
										@if ($errors->has('police_station'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('police_station') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="police_officer_name" class="col-sm-3 col-form-label">Police Officer's Name</label>
										<div class="col-sm-9">
										{{ Form::text('police_officer_name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Police Officer Name' )) }}
										@if ($errors->has('police_officer_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('police_officer_name') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>
							</div>
							{{ Form::close() }}   
						</div> 
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="addCustomermodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Customer</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
			</div>
			{{ Form::open(array('url' => 'admin/contact/add', 'name'=>"add-customer", 'autocomplete'=>'off', "enctype"=>"multipart/form-data", 'id'=>'addcustomer')) }}
			<div class="modal-body">
				<div class="customerror"></div>
				<div class="form-group row">  
					<label for="srname" class="col-sm-2 col-form-label">Primary Name <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-1">
						<select style="padding: 0px 5px;" name="srname" id="srname" class="form-control" autocomplete="new-password">
							<option value="Mr">Mr</option>
							<option value="Mrs">Mrs</option>
							<option value="Ms">Ms</option>
							<option value="Miss">Miss</option>
							<option value="Dr">Dr</option>
						</select>
						<span class=""></span>
					</div>
					<div class="col-sm-3">
					{{ Form::text('first_name', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'First Name *' )) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('middle_name', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Middle Name' )) }}
					</div>
					<div class="col-sm-3">
					{{ Form::text('last_name', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Last Name *' )) }}
					</div>  
				</div>	
				<div class="form-group row">
					<label for="company_name" class="col-sm-2 col-form-label">Company Name <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
						{{ Form::text('company_name', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Company Name *' )) }}
					</div>
				</div>
				<div class="form-group row"> 
					<label for="contact_display_name" class="col-sm-2 col-form-label">Contact Display Name <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
					{{ Form::text('contact_display_name', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Contact Display Name *' )) }}
					</div>
				</div>
				<div class="form-group row"> 
					<label for="contact_email" class="col-sm-2 col-form-label">Contact Email <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
					{{ Form::text('contact_email', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Contact Email *' )) }}
					</div>
				</div>
				<div class="form-group row"> 
					<label for="contact_phone" class="col-sm-2 col-form-label">Contact Phone <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
					{{ Form::text('contact_phone', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Contact Phone *' )) }}
					</div>
				</div>
				<div class="form-group row"> 
					<label for="currency" class="col-sm-2 col-form-label">Currency</label>
					<div class="col-sm-10">
					<select name="currency" data-valid="required" class="form-control">
							@foreach(\App\Currency::where('is_base','=','1' )->orwhere('user_id',Auth::user()->id)->orderby('currency_code','ASC')->get() as $cclist)
								<option value="{{$cclist->id}}" @if($cclist->is_base == 1) selected @endif>{{$cclist->currency_code}}-{{$cclist->name}}</option>
							@endforeach
					</select>
					</div>
			</div> 
			</div>
			<div class="modal-footer justify-content-between">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button type="button" id="customer_save" class="btn btn-primary">Save</button>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="modal fade" id="billing_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Billing Address</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
			</div>
			{{ Form::open(array('url' => 'admin/contact/storeaddress', 'name'=>"add-billingdetail", 'autocomplete'=>'off', "enctype"=>"multipart/form-data", 'id'=>'updatebillingdetail')) }}
			<div class="modal-body">
				
					<input type="hidden" value="" name="customer_id" id="customer_id">
					<div class="customerror"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="subject" class="col-form-label">Country</label>
								<div name="country" class="country_input" id="select_country" data-input-name="country"></div>
							</div>
							<div class="form-group">
								<label for="address" class="col-form-label">Address</label>
								<textarea name="address" id="address" class="form-control" placeholder="Address" style="width: 100%; height:80px;padding: 10px;margin-bottom:10px;"></textarea>
							</div>
							<div class="form-group">
								<label for="city" class="col-form-label">City</label>
								{{ Form::text('city', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'City Name','id'=>'city' )) }}
							</div>
							<div class="form-group">
								<label for="zipcode" class="col-form-label">ZipCode</label>
								{{ Form::text('zipcode', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Zipcode','id'=>'zipcode' )) }}
							</div>
							<div class="form-group">
								<label for="phone" class="col-form-label">Phone</label>
								{{ Form::text('phone', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Phone','id'=>'phone' )) }}
							</div>
							
						</div>
					</div>.
				
			</div>
			<div class="modal-footer justify-content-between">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="billing_save" class="btn btn-primary">Save</button>
				</div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@endsection