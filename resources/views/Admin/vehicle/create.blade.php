@extends('layouts.admin')
@section('title', 'Create Vehicle')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Create Vehicle</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Create Vehicle</li>
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
							<h3 class="card-title">Create Vehicle</h3>
						</div>
					  <!-- /.card-header -->
						<div class="card-body">
							<!-- form start -->
						{{ Form::open(array('url' => 'admin/vehicle/store', 'name'=>"add-claim", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
													<option value="{{@$clist->id}}">{{@$clist->title}} {{@$clist->owner_name}}</option>
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
										{{ Form::text('makemodal', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Year, Make & Modal' )) }}
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
										{{ Form::text('veh_reg', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Vehicle Registration' )) }}
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
										{{ Form::text('vin_no', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'VIN Number' )) }}
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
										{{ Form::text('excess', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Excess' )) }}
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
											<option value="Ride Share">Ride Share</option>
											<option value="Uber">Uber</option>
											<option value="Taxi">Taxi</option>
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
										{{ Form::text('joining_date', '', array('class' => 'form-control commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Joining Date' )) }}
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
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_two" class="col-form-label">Image 2</label>
										<input type="file" name="licence_two" >
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_three" class="col-form-label">Image 3</label>
										<input type="file" name="licence_three" >
									</div>
								</div> 
								<div class="col-sm-6">
									<div class="form-group">
										<label for="licence_four" class="col-form-label">Image 4</label>
										<input type="file" name="licence_four" >
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label for="vic_certificate" class="col-form-label">Vic Road Certificate</label>
										<input type="file" name="vic_certificate" >
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
<script>
jQuery(document).ready(function(){
	/* $('input[name="claim"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_claim').show();
			$('#claim_file').attr('data-valid','required');
		}else{
			$('.is_claim').hide();
			$('#claim_file').attr('data-valid','');
		}
	});
	$('input[name="assessment_report"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_assessment_report').show();
			$('#assessment_report_file').attr('data-valid','required');
		}else{
			$('.is_assessment_report').hide();
			$('#assessment_report_file').attr('data-valid','');
		}
	});
	$('input[name="payslip"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_payslip').show();
			$('#payslip_file').attr('data-valid','required');
		}else{
			$('.is_payslip').hide();
			$('#payslip_file').attr('data-valid','');
		}
	});
	$('input[name="hirecar_agreement"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_hirecar_agreement').show();
			$('#hirecar_agreement_file').attr('data-valid','required');
		}else{
			$('.is_hirecar_agreement').hide();
			$('#hirecar_agreement_file').attr('data-valid','');
		}
	});
	$('input[name="hirecar_invoice"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_hirecar_invoice').show();
			$('#hirecar_invoice_file').attr('data-valid','required');
		}else{
			$('.is_hirecar_invoice').hide();
			$('#hirecar_invoice_file').attr('data-valid','');
		}
	});
	$('input[name="rego_paper"]').on('click', function(){
		if($(this).val() == 1){
			$('.is_rego_paper').show();
			$('#rego_paper_file').attr('data-valid','required');
		}else{
			$('.is_rego_paper').hide();
			$('#rego_paper_file').attr('data-valid','');
		}
	});	
	$('input[name="repair_invoice"]').on('click', function(){ 
		if($(this).val() == 1){
			$('.is_repair_invoice').show();
			$('#repair_invoice_file').attr('data-valid','required');
		}else{
			$('.is_repair_invoice').hide();
			$('#repair_invoice_file').attr('data-valid','');
		}
	}); */
});
</script>

@endsection