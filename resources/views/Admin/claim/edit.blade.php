@extends('layouts.admin')
@section('title', 'Accident Claim Form')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Accident Claim Form</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Accident Claim Form</li>
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
							<h3 class="card-title">Accident Claim Form</h3>
						</div>
					  <!-- /.card-header -->
						<div class="card-body">
							<!-- form start -->
						{{ Form::open(array('url' => 'admin/claim/edit', 'name'=>"add-claim", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
						<input type="hidden" name="id" value="{{@$fetchedData->id}}">
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="{{route('admin.claim.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
								{{ Form::button('<i class="fa fa-edit"></i> Edit', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("add-claim")' ]) }}
							</div> 	 
							<div class="row"> 
								<div class="col-sm-12">    
									<div class="form-group row">  
										<label for="customer_name" class="col-sm-3 col-form-label">Member Name <span style="color:#ff0000;">*</span></label>
										<div class="col-sm-9">
											<select id="customer_name" name="customer_name" data-valid="required" class="form-control select2bs4" style="width: 100%;">
												<option value="">Select Member</option>
												@foreach(\App\Member::all() as $clist)
													<option value="{{@$clist->id}}" @if($fetchedData->customer_name == $clist->id) selected @endif>{{@$clist->title}} {{@$clist->owner_name}}</option>
												@endforeach
											</select>
											<span class="currencydata"></span>
											
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
									<div class="addresslist" style="<?php if($fetchedData->customer_name != ''){ }else{ echo 'display:none;'; } ?> ">
										@if($fetchedData->customer_name != '')
											<?php $cusdetail = \App\Member::where('id',$fetchedData->customer_name)->first(); ?>
											<span style="">Billing Address <a href="javascript:;" id="{{$cusdetail->id}}" class="change_address">Change</a></span>
											<address style="" id="">{{$cusdetail->address}}<br>{{$cusdetail->phone}}</address>
											<script>
										
												billingdata[0] = {
												"customer_id":'<?php echo $cusdetail->id; ?>',
												"address":'<?php echo $cusdetail->address; ?>',
												"city":'<?php echo $cusdetail->city; ?>',
												"zipcode":'<?php echo $cusdetail->zipcode; ?>',
												"phone":'<?php echo $cusdetail->phone; ?>',
												"country":'<?php echo $cusdetail->country; ?>',
													}
											</script>
										@endif
										</div>
								</div>
							</div>
							<div class="row"> 
							<div class="col-sm-6">										
									<div class="form-group">
										<label for="accident_date" class="col-form-label">Date of Accident</label>
										{{ Form::text('accident_date', @$fetchedData->date_of_accident, array('class' => 'form-control commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'Invoice Date' )) }}
										@if ($errors->has('accident_date'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('accident_date') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="rego_no" class="col-form-label">Rego Number <span style="color:#ff0000;">*</span></label>
										{{ Form::text('rego_no',@$fetchedData->rego_no, array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'' )) }}
										@if ($errors->has('rego_no'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('rego_no') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="claim" class="col-form-label">Claim Form</label>
										
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input type="radio" class="form-check-input" <?php if($fetchedData->claim == 1){ echo 'checked'; } ?> value="1" name="claim" id="claim_yes" /><label class="form-check-label" for="claim_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="radio" class="form-check-input" value="0" name="claim" <?php if($fetchedData->claim == 0){ echo 'checked'; } ?> id="claim_no" />
												<label class="form-check-label" for="claim_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->claim == 1){}else{ ?>style="display:none;"
											<?php } ?>  class="form-check form-check-inline is_claim custom_form_label upload_file_field">
												<input type="file" class="" name="claim_file" id="claim_file" /> 
												<a href="#" class="upload_btn">Upload</a>
												
											</div> 
											<?php /* if($fetchedData->claim == 1 && $fetchedData->claim_file != ''){ ?>
											<input type="hidden" name="old_claim_file" value="<?php echo @$fetchedData->claim_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->claim_file}}" target="_blank"><?php echo $fetchedData->claim_file; ?></a><?php } */ ?>											
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="assessment_report" class="col-form-label">Assessment Report Upload</label>
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input  <?php if($fetchedData->assessment_report == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="assessment_report" id="assessment_report_yes" /><label class="form-check-label" for="assessment_report_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->assessment_report == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="assessment_report" id="assessment_report_no" />
												<label class="form-check-label" for="assessment_report_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->assessment_report == 1){}else{ ?>style="display:none;"
											<?php } ?> class="form-check form-check-inline is_assessment_report custom_form_label upload_file_field">
												<input type="file" class="" name="assessment_report_file" id="assessment_report_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div>  
											<?php /* if($fetchedData->assessment_report == 1 && $fetchedData->assessment_report_file != ''){ ?>
											<input type="hidden" name="old_assessment_report_file" value="<?php echo @$fetchedData->assessment_report_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->assessment_report_file}}" target="_blank"><?php echo @$fetchedData->assessment_report_file; ?></a><?php } */ ?>
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="payslip" class="col-form-label">Pay Slips Upload</label>  
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->payslip == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="payslip" id="payslip_yes" /><label class="form-check-label" for="payslip_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->payslip == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="payslip" id="payslip_no" />
												<label class="form-check-label" for="payslip_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->payslip == 1){}else{ ?>style="display:none;"
											<?php } ?> class="form-check form-check-inline is_payslip custom_form_label upload_file_field">
												<input type="file" class="" name="payslip_file" id="payslip_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div> 
											<?php /* if($fetchedData->payslip == 1 && $fetchedData->payslip_file != ''){ ?>
											<input type="hidden" name="old_payslip_file" value="<?php echo @$fetchedData->payslip_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->payslip_file}}" target="_blank"><?php echo $fetchedData->payslip_file; ?></a><?php } */ ?>											
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="hirecar_agreement" class="col-form-label">Hire Car Agreement</label>
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->hirecar_agreement_yes == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="hirecar_agreement" id="hirecar_agreement_yes" /><label class="form-check-label" for="hirecar_agreement_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->hirecar_agreement_yes == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="hirecar_agreement" id="hirecar_agreement_no" />
												<label class="form-check-label" for="hirecar_agreement_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->hirecar_agreement == 1){}else{ ?>style="display:none;"
											<?php } ?> class="form-check form-check-inline is_hirecar_agreement custom_form_label upload_file_field">
												<input type="file" class="" name="hirecar_agreement_file" id="hirecar_agreement_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div>  
											<?php /* if($fetchedData->hirecar_agreement == 1 && $fetchedData->hirecar_agreement_file != ''){ ?>
											<input type="hidden" name="old_hirecar_agreement_file" value="<?php echo @$fetchedData->hirecar_agreement_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->hirecar_agreement_file}}" target="_blank"><?php echo $fetchedData->hirecar_agreement_file; ?></a><?php } */ ?>
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="hirecar_invoice" class="col-form-label">Hire Car Invoice Upload</label>
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->hirecar_invoice == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="hirecar_invoice" id="hirecar_invoice_yes" /><label class="form-check-label" for="hirecar_invoice_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->hirecar_invoice == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="hirecar_invoice" id="hirecar_invoice_no" />
												<label class="form-check-label" for="hirecar_invoice_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->hirecar_invoice == 1){}else{ ?>style="display:none;"
											<?php } ?>  class="form-check form-check-inline is_hirecar_invoice custom_form_label upload_file_field">
												<input type="file" class="" name="hirecar_invoice_file" id="hirecar_invoice_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div>  
											<?php /* if($fetchedData->hirecar_invoice == 1 && $fetchedData->hirecar_invoice_file != ''){ ?>
											<input type="hidden" name="old_hirecar_invoice_file" value="<?php echo @$fetchedData->hirecar_invoice_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->hirecar_invoice_file}}" target="_blank"><?php echo $fetchedData->hirecar_invoice_file; ?></a><?php } */ ?>
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="rego_paper" class="col-form-label">Rego Paper Upload</label>
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->rego_paper == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="rego_paper" id="rego_paper_yes" /><label class="form-check-label" for="rego_paper_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->rego_paper == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="rego_paper" id="rego_paper_no" />
												<label class="form-check-label" for="rego_paper_no">No</label>
											</div>
											<div style="display:none;" <?php if($fetchedData->rego_paper == 1){}else{ ?>style="display:none;"
											<?php } ?>  class="form-check form-check-inline is_rego_paper custom_form_label upload_file_field">
												<input type="file" class="" name="rego_paper_file" id="rego_paper_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div>  
											<?php /* if($fetchedData->rego_paper == 1 && $fetchedData->rego_paper_file != ''){ ?>
											<input type="hidden" name="old_rego_paper_file" value="<?php echo @$fetchedData->rego_paper_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->rego_paper_file}}" target="_blank"><?php echo $fetchedData->rego_paper_file; ?></a><?php } */ ?>
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
									<div class="form-group row">   
										<label for="repair_invoice" class="col-form-label">Repair Invoice</label>
										<div class="col-sm-12">
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->repair_invoice == 1){ echo 'checked'; } ?> type="radio" class="form-check-input" value="1" name="repair_invoice" id="repair_invoice_yes" /><label class="form-check-label" for="repair_invoice_yes">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input <?php if($fetchedData->repair_invoice == 0){ echo 'checked'; } ?> type="radio" class="form-check-input" value="0" name="repair_invoice" id="repair_invoice_no" />
												<label class="form-check-label" for="repair_invoice_no">No</label>
											</div>
											<div style="display:none;" <?php /* if($fetchedData->repair_invoice == 1){}else{ ?>style="display:none;"
											<?php } */ ?> class="form-check form-check-inline is_repair_invoice custom_form_label upload_file_field">
												<input type="file" class="" name="repair_invoice_file" id="repair_invoice_file" /> 
												<a href="#" class="upload_btn">Upload</a>
											</div>  
											<?php /* if($fetchedData->repair_invoice == 1 && $fetchedData->repair_invoice_file != ''){ ?>
											<input type="hidden" name="old_repair_invoice_file" value="<?php echo @$fetchedData->repair_invoice_file; ?>">
											<a href="{{URL::to('/public/img/accident_claim')}}/{{$fetchedData->repair_invoice_file}}" target="_blank"><?php echo $fetchedData->repair_invoice_file; ?></a><?php } */ ?>
										</div> 
									</div>
								</div>
								<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="tow_invoice" class="col-form-label">Tow invoice</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="tow_invoice" id="tow_yes" <?php if($fetchedData->tow_invoice == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="tow_yes">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="tow_invoice" id="tow_no" <?php if($fetchedData->tow_invoice == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="tow_no">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="demand_letter" class="col-form-label">Demand letter</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="demand_letter" id="demand_ley" <?php if($fetchedData->demand_letter == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="demand_ley">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="demand_letter" id="demand_len" <?php if($fetchedData->demand_letter == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="demand_len">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="loss_in_paid" class="col-form-label">	Loss of income paid</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="loss_in_paid" id="loss_in_paidy" <?php if($fetchedData->loss_in_paid == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="loss_in_paidy">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="loss_in_paid" id="loss_in_paidn" <?php if($fetchedData->loss_in_paid == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="loss_in_paidn">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="parts_invoice" class="col-form-label">	Parts Invoice</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="parts_invoice" id="parts_invoicey" <?php if($fetchedData->parts_invoice == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="parts_invoicey">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="parts_invoice" id="parts_invoicen" <?php if($fetchedData->parts_invoice == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="parts_invoicen">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="case_closed" class="col-form-label">	Case closed</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="case_closed" id="case_closedy" <?php if($fetchedData->case_closed == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="case_closedy">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="case_closed" id="case_closedn" <?php if($fetchedData->case_closed == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="case_closedn">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="money_claim" class="col-form-label">	Money received for claim</label>
		<div class="col-sm-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" value="1" name="money_claim" id="money_claimy" <?php if($fetchedData->money_claim == 1){ echo 'checked'; } ?> /><label class="form-check-label" for="money_claimy">Yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input  type="radio" class="form-check-input" value="0" name="money_claim" id="money_claimn" <?php if($fetchedData->money_claim == 0){ echo 'checked'; } ?> />
				<label class="form-check-label" for="money_claimn">No</label> 
			</div> 
		</div> 
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="excess_paid_qoa" class="col-form-label">	Excess paid to QOA</label>
		<div class="col-sm-12">
			<input type="text" value="{{$fetchedData->excess_paid_qoa}}" name="excess_paid_qoa" class="form-control">
		</div>
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="excess_paid_aus_taxi" class="col-form-label">Excess paid to AUS Taxi</label>
		<div class="col-sm-12">
			<input type="text" value="{{$fetchedData->excess_paid_aus_taxi}}" name="excess_paid_aus_taxi" class="form-control">
		</div>
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="lawyers" class="col-form-label">Lawyers</label>
		<div class="col-sm-12">
			<input type="text" value="{{$fetchedData->lawyers}}" name="lawyers" class="form-control">
		</div>
	</div>
</div>
<div class="col-sm-6">    
	<div class="form-group row">   
		<label for="comment" class="col-form-label">Comment box</label>
		<div class="col-sm-12">
			<textarea class="form-control" name="comment">{{$fetchedData->comment}}</textarea>
		</div>
	</div>
</div>
							</div>
							
							<input id="save_type" name="save_type" type="hidden" value="save_send">
							<div class="form-group" style="text-align:right;">
								{{ Form::button('<i class="fa fa-edit"></i> Edit', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("add-claim")' ]) }}
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