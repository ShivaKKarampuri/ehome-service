@extends('layouts.admin')
@section('title', 'Third Party Cover')

@section('content')
<?php use App\Http\Controllers\Controller; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Third Party Cover</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Third Party Cover</li>
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
					<div class="custom-error-msg"></div>
					<!-- Flash Message End -->
				</div> 
				<div class="col-md-4">					
					<div class="card">
						<div class="card-body p-0" style="display: block;">
							<div class="mailbox-controls">
								<!-- Check all button -->
								<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
								</button>
								<!--<a href="javascript:;" class="btn btn-inline-block btn-default btn-sm is_selected_invoice">Mark as Sent</a>  -->
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-default btn-sm is_selected_invoice" data-toggle="dropdown" href="#" aria-expanded="false">
									 More <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <!--<a class="dropdown-item" tabindex="-1" href="#">Bulk Update</a>-->
									 
									  <a class="dropdown-item print_allinvoice" tabindex="-1" href="javascript:;">Print</a>
									  <a class="dropdown-item exportpdf" tabindex="-1" href="javascript:;">Export as PDF</a>
									  <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="deleteAllAction('invoices')">Delete</a>
									</div> 
					
								<span class="is_selected_invoice">	<span class="selected_no"></span> Selected</span> 
								</div> 
								
								<!--<div class="float-right new_invoice ">
									<ul>
										<li class="nav-item d-none d-sm-inline-block quick_link">
											<a class="dropdown-toggle btn btn-block btn-outline-primary btn-sm is_not_selected_invoice" data-toggle="dropdown" href="#" aria-expanded="false">
											 <i class="fa fa-plus"></i> New <span class="caret"></span>
											</a> 
											<div class="dropdown-menu" x-placement="top-start">
											  <a class="dropdown-item" tabindex="-1" href="#">New Invoice</a>
											  <a class="dropdown-item" tabindex="-1" href="#">New Invoice (Pre GST)</a>
											  <a class="dropdown-item" tabindex="-1" href="#">New Recurring Invoice</a> 
											  <a class="dropdown-item" tabindex="-1" href="#">New Debit Note</a>
											  <a class="dropdown-item" tabindex="-1" href="#">New Credit Note</a>
											  <a class="dropdown-item" tabindex="-1" href="#">New Credit Note (Pre GST)</a>
											</div>
										</li>
									</ul>	
								</div>-->
							<?php	
								$today = date('Y-m-d');
										
										?>
								<!-- /.float-right -->
								<div class="table-responsive invoice_table mailbox-messages">
									<table class="table table-hover table-striped">
										<tbody>
										@foreach($lists as $list)
											<tr>
												<td class="check_td">
												  <div class="icheck-primary">
													<input type="checkbox" name="invoicelist" class="seleccheckbox" value="{{@$list->id}}" id="check{{@$list->id}}">
													<label for="check{{@$list->id}}"></label>
												  </div>
												</td>
												<td class="thirdlist_td" invoiceid="{{base64_encode(convert_uuencode(@$list->id))}}">
													<div class="list_primary">
													<?php $currncydata = \App\Currency::where('id',$list->currency_id)->first(); ?>
														<span class="float-right amount"> ${{number_format($list->amount, 2)}} </span>
														<div class="name" title="{{$list->customer->first_name}} {{$list->customer->last_name}}">{{$list->customer->first_name}} {{$list->customer->last_name}}</div>
													</div>
													<div class="list_secondary">
														<?php
										$count = 2;
										$datetime1 = new DateTime($today);
										$datetime2 = new DateTime($list->due_date);
										$interval = $datetime1->diff($datetime2);
										$diff = $interval->format('%a');
										if(strtotime($today) > strtotime($list->due_date) && $list->status != 1){
											echo '<span class="float-right text-overdue text-uppercase">OVERDUE BY '.$diff.' DAYS<i class="fa fa-envelope-o"></i></span>';
										}else{	
											if($list->status == 1){
												echo '<span class="float-right text-accepted text-uppercase">Paid<i class="fa fa-envelope-o"></i></span>';
											}else if($list->status == 2){
												echo '<span class="float-right text-sent text-uppercase">Sent<i class="fa fa-envelope-o"></i></span>';
											}else if($list->status == 3){
												echo '<span class="float-right text-accepted text-uppercase">Partially Paid<i class="fa fa-envelope-o"></i></span>';
											}else{
												echo '<span class="float-right text-sent text-uppercase">Draft<i class="fa fa-envelope-o"></i></span>';
											}
										}
									?> 
														<div class="number">{{$list->invoice}} </div>
														<span class="text-muted separationline">{{date('d/m/Y',strtotime($list->invoice_date))}}</span>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>		
								</div>
								
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<?php $currencydata = \App\Currency::where('id',$invoicedetail->currency_id)->first(); ?>
				<div class="col-md-8 showinvoicedata">
					<div class="card card-primary card-outline invoice_list">
						<div class="card-header">
							<h3 class="card-title">{{$invoicedetail->invoice}}</h3>
							<div class="card-tools attach_comment">
								<ul class="">
									<li><a href="javascript:;" dataid="{{base64_encode(convert_uuencode(@$invoicedetail->id))}}" class="attach_filemodel"><i class="fa fa-paperclip"></i>Attach File(s)</a></li> 
									<li><a href="javascript:;" class="commenthistory" dataid="{{$invoicedetail->id}}"><i class="fa fa-comment"></i>Comments & History</a></li> 
									<li><a href="javascript:;"><i class="fa fa-close"></i></a></li>
								</ul>
							</div>
						  <!-- /.card-tools -->
						</div>  
						<!-- /.card-header --> 
						<div class="card-body p-0">
							<div class="custom_card_header">
								<a href="{{URL::to('/admin/thirdparty/edit/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}" class="btn btn-inline-block btn-sm cus_btn"><i class="fa fa-edit"></i> Edit</a>  
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> Mail <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/thirdparty/email/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">Send Mail</a>
									</div> 
								</div>
								
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> PDF / Print <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/thirdparty/download/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">PDF</a>
									  <a class="dropdown-item thprint_invoice" tabindex="-1" dataid="{{base64_encode(convert_uuencode(@$invoicedetail->id))}}" href="javascript:;">Print</a>
									</div> 
								</div>
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> Reminders <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/thirdparty/reminder/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">Send Now</a>
									  <a class="dropdown-item" tabindex="-1" href="#">Stop Reminders</a>
									</div> 
								</div>
								<!--<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-ellipsis-h"></i>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="#">Make Recurring</a>
									  <a class="dropdown-item" tabindex="-1" href="#">Create Credit Note</a>
									  <a class="dropdown-item" tabindex="-1" href="#">Create Debit Note</a>
									  <a class="dropdown-item" tabindex="-1" href="#">Clone</a>
									  <div class="dropdown-divider"></div>
									  <a class="dropdown-item" tabindex="-1" href="#">Delete</a>
									</div> 
								</div>-->
							</div>
							
						</div>
						<!-- /.card-body -->
						<?php
							$paymentdetail = \App\InvoicePayment::where('invoice_id',$invoicedetail->id)->get();

							$paymentcount = \App\InvoicePayment::where('invoice_id',$invoicedetail->id)->count();
						?>
						@if($invoicedetail->status == 1)
						<div id="accordion" class="cus_accordian">
							<div class="card-header">
								<h4 class="card-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">Payments Received <span>{{$paymentcount}}</span>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse in collapse" style="">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>Date</th>
													<th>Payment #</th>
													<th>Payment Mode</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($paymentdetail as $pd)
												<tr>
													<td>{{date('d/m/Y',strtotime($pd->payment_date))}}</td>
													<td><a href="#">{{@$pd->id}}</a></td>
										
													<td>{{@$pd->payment_mode}}</td>
													<td>₹{{number_format(@$pd->amount_rec)}}</td>
													<td>
														<div class="nav-item dropdown action_dropdown">
															<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
															<div class="dropdown-menu">
															 <a href="javascript:;" dataid="{{@$pd->id}}" class="editpaymentmodel"><i class="fa fa-edit"></i> Edit</a>
															 <a href="javascript:;" onclick=""><i class="fa fa-trash"></i> Delete</a>
															</div> 
														</div>
													</td>
												</tr> 
											@endforeach
											</tbody>
										</table>	
									</div>
								</div>
							</div>  
						</div>
						@elseif($invoicedetail->status == 3)
							<div id="acdion" class="cusaccordian">
								<div class="card-header">
									<a href="javascript:;" dataid="{{$invoicedetail->id}}" class="btn bg-purple margin payment_modal">Record Payment</a>
								</div>
							</div>
							
							<div id="accordion" class="cus_accordian">
							<div class="card-header">
								<h4 class="card-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">Payments Received <span>{{$paymentcount}}</span>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse in collapse" style="">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>Date</th>
													<th>Payment #</th>
													
													<th>Payment Mode</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($paymentdetail as $pd)
												<tr>
													<td>{{date('d/m/Y',strtotime($pd->payment_date))}}</td>
													<td><a href="#">{{@$pd->id}}</a></td>
										
													<td>{{@$pd->payment_mode}}</td>
													<td>${{number_format(@$pd->amount_rec,2)}}</td>
													<td>
														<div class="nav-item dropdown action_dropdown">
															<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
															<div class="dropdown-menu">
															 <a href="javascript:;" dataid="{{@$pd->id}}" class="editpaymentmodel"><i class="fa fa-edit"></i> Edit</a>
															 <a href="javascript:;" onclick=""><i class="fa fa-trash"></i> Delete</a>
															</div> 
														</div>
													</td>
												</tr> 
											@endforeach  
											</tbody>
										</table>	
									</div>
								</div>
							</div>  
						</div>
						@else
							
							<div id="accordion" class="cus_accordian">
								<div class="card-header">
									<a href="javascript:;" dataid="{{$invoicedetail->id}}" class="btn bg-purple margin payment_modal">Record Payment</a>
								</div>
							</div>
						@endif
					</div>
				  <!-- /.card -->
					<div class="card card-primary">						
						<div id="invoice_085" class="ember-view invoice_template">
						<?php if(strtotime($today) > strtotime($invoicedetail->due_date) && $invoicedetail->status != 1){
							$stattyp = 'Overdue';
							$classty = 'danger';
						}else{	
							if($invoicedetail->status == 1){
								$stattyp = 'Paid';
								$classty = 'success';
							}else if($invoicedetail->status == 2){
								$stattyp = 'Sent';
								$classty = 'open';
							}else if($invoicedetail->status == 3){
								$stattyp = 'Partially Paid';
								$classty = 'success';
							}else{
								$stattyp = 'Draft';
								$classty = 'danger';
							}
						} 
						?>
							<div id="invoice_ribbben" class="ribbon text-ellipsis tooltip-container ember-view"><div class="ribbon-inner ribbon-<?php  echo $classty; ?>"><?php echo $stattyp;  ?></div></div>
							<style media="all">
								.invoice_template table.inv-itemtable tr th, .invoice_template table.inv-itemtable tr td {
								padding: 5px;}
								.invoice_template table.inv-totaltable tr td{font-size:16px;line-height:24px;padding-bottom: 5px;padding-left: 10px;color: #000;}
							</style> 
							<div class="inv-template" style="padding:50px;">  
								<div class="inv-template-header inv-header-content" id="header">
									<div class="inv-template-fill-emptydiv"></div>
									<div style="width:220px;margin:0px auto 10px;" class="invoice-logo">
										<img style="width:100%;" src="{!! asset('public/img/austaxilogo.PNG') !!}" alt=""/>
									</div>
								</div>
								<div class="inv-template-body">
									<div style="border: 1px solid #9e9e9e;" class="inv-template-bodysection">
										<table style="width: 100%;border-bottom:1px solid #000;">
											<tbody>
												<tr>
													<td style="width:40%;padding: 5px;vertical-align: top;border-right: 1px solid #000;" align="left">
														<div style="font-size: 28px;color: #000;line-height:32px;">TAX INVOICE</div>
														<span style="text-align:center;display:block;font-size:14px;line-height:18px;color: #000;">{{@$invoicedetail->customer->title}} {{@$invoicedetail->customer->owner_name}}</span>
													</td>
													<td style="width:50%;vertical-align: middle;padding: 2px 8px;">
														<div style="width:50%;float:left;font-size:14px;line-height:18px;color: #000;">
															<span style="display:block;margin-bottom:5px;"><b>Invoice Date</b><br/>{{date('d M Y',strtotime($invoicedetail->invoice_date))}}</span>
															<span style="display:block;margin-bottom:5px;"><b>Invoice Number</b><br/>{{$invoicedetail->invoice}}</span>
															<span style="display:block;margin-bottom:5px;"><b>Reference</b><br/></span>
															<span style="display:block;margin-bottom:5px;"><b>ABN</b><br/>{{@$invoicedetail->customer->abn}}</span>
														</div>
														<div style="width:50%;float:left;font-size:14px;line-height:21px;color: #000;">
															<p>{{@Auth::user()->company_name}}<br/>{{@Auth::user()->phone}}<br/>{{@Auth::user()->state}}<br/>{{@Auth::user()->address}}<br/>{{@Auth::user()->city}} {{@Auth::user()->zip}}<br/>AUSTRALIA</p>
														</div>
													</td>
												</tr>
											</tbody>
										</table>

										<div style="border-bottom:1px solid #000;">
											<table cellspacing="0" cellpadding="0" border="1" style="width: 100%;border-right:1px solid #000;" class="inv-itemtable">
												<thead>
													<tr style="font-size: 14px;line-height:18px;color:#000;">													
														<th>Item</th>
														<th>Description</th>
														<th>Quantity</th>
														<th>Unit Price (Exclude GST)</th>
														<th>Unit Price (Include GST)</th>
														<th>Amount AUD</th>
													</tr>
												</thead>
												<tbody>
													
												<?php $ist = 1; $subtotal = 0; ?>
												@foreach($invoicedetail->invoicedetail as $lst)
												<?php $ntotal = $lst->quantity * $lst->rate; ?>
													<tr style="font-size: 13px;line-height:18px;color:#000;">
														<td>{{$lst->item_name}}</td>
														<td>Third party insurance cover for M8015 covering upto $35 million and third party
damages.Third party insurance cover starts
from <?php echo date('d/m/Y', strtotime($invoicedetail->invoice_date)); ?> and expires on <?php echo date('d/m/Y', strtotime("+12 months", strtotime($invoicedetail->invoice_date))); ?>.</td>
<?php
$tp = $lst->rate / 11;
$exgst = $lst->rate - $tp;
?>
														<td>{{number_format($lst->quantity,2)}}</td>
														<td>{{number_format($exgst,2)}}</td>
														
														<?php 
															if(@$invoicedetail->tax != 0)
														{ 
															$cure = 10; 
															$taxcal = 0;
															$ntotal = $ntotal + $taxcal;
														}
														?>
														<td>{{number_format($ntotal,2)}}</td>
														<td>{{number_format($ntotal,2)}}</td>
													</tr>
													<?php 
												$subtotal += $ntotal;
												$ist++; ?>
													@endforeach
												</tbody>
											</table>
										</div>
										<div style="font-size: 14px;line-height: 18px;padding: 10px;border-bottom: 1px solid #000;color: #000;">
											<p style="margin:0px;">NOTE: DO NOT ASK TO CONSIDER ANY CLAIMS IF HAPPENS AFTER THE DUE DATE OF PREMIUM TO BE PAID.</p>
										</div>
										<div style="clear:both;"></div>
										
										
										<div style="width: 100%;border-bottom: 1px solid #9e9e9e;">
											<div style="width: 50%;padding: 4px 4px 3px 7px;float: left;">
											</div>
											<div style="width: 43.6%;float:right;" class="inv-totals">
												<table style="border-left: 1px solid #9e9e9e;" class="inv-totaltable" id="itemTable" cellspacing="0" border="0" width="100%">
													<tbody>
														<?php
														if($invoicedetail->discount_type == 'fixed'){ 
														$discoun = $invoicedetail->discount;
														$finaltotal = $subtotal - $invoicedetail->discount;
													  }else{
														 $discoun = ($subtotal * $invoicedetail->discount) / 100; 
														 $finaltotal = $subtotal - $discoun;
														 
													  } 
														/* if(@$invoicedetail->tax != 0)
														{
															$cure = 10; 
															$taxcal = ($finaltotal * $cure) / 100;
															$finaltotal = $finaltotal + $taxcal;
														} */ 
														
														$amount_rec = \App\InvoicePayment::where('invoice_id',$invoicedetail->id)->get()->sum("amount_rec");

														$ispaymentexist = \App\InvoicePayment::where('invoice_id',$invoicedetail->id)->exists();
														
													  ?>  
														<tr>
															<td valign="middle">Sub Total</td>
															<td valign="middle">{{number_format($finaltotal,2)}}</td>
														</tr>
														<?php 
														  /*if($invoicedetail->discount != 0){
														?>
														<tr>
														<td>Discount(<?php if($invoicedetail->discount_type == 'fixed'){ echo '$'; } ?>{{$invoicedetail->discount}} <?php if($invoicedetail->discount_type == 'percentage'){ echo '%'; } ?>)</td>
														<td id="tmp_total" valign="middle" style="width:110px;">(-) <?php echo $discoun; ?></td>
														</tr>
														  <?php }*/ ?>
														<!--<tr>
															<td valign="middle">Total GST 10%</td>
															<td valign="middle">{{number_format($taxcal,2)}}</td>
														</tr>-->
														<tr>
															<td style="border-bottom: 1px solid #9e9e9e;" colspan="2"></td>
														</tr>
														<tr>
															<td valign="middle"><b>Total AUD</b></td>
															<td valign="middle"><b>{{number_format($finaltotal,2)}}</b></td>
														</tr>
														@if($ispaymentexist)
																<?php $baldue = $finaltotal - $amount_rec; ?>
														<tr style="height:10px;">
															<td valign="middle">Payment Made</td>
															<td valign="middle" style="width:110px;color: red;">(-) {{number_format($amount_rec, 2)}}</td>
														</tr>
														<tr style="height:10px;" class="inv-balance">
															<td valign="middle"><b>Balance Due</b></td>
															<td id="tmp_balance_due" valign="middle" style="width:110px;;"><strong>{{number_format($baldue, 2)}}</strong></td>
														</tr>
														@endif
													</tbody>
												</table>
											</div>
											<div style="clear: both;"></div>
										</div>
										<div style="padding:10px;">
											<span style="font-size:18px;line-height:24px;color:#000;font-weight: 600;">Due Date: {{date('d M Y',strtotime($invoicedetail->invoice_date))}}</span>
											<p style="font-size:14px;line-height:18px;color:#000;margin:0px 0px 10px;">{{@Auth::user()->company_name}}<br/>BANK - ANZ<br/>BSB - 013303<br/>ACCOUNT NUMBER - 415369862</p>
											<p style="font-size:14px;line-height:18px;color:#000;margin:0px;"><b>Note:</b> Please mention your TAXI REGO in description field when you pay</p>
										</div>
										<table style="width: 100%;border-top:1px dashed #000;margin:20px 0px 10px;">
											<tbody>
												<tr>
													<td style="width:50%;">
														<span style="font-size:30px;line-height:34px;color:#000;padding: 20px 0px 30px;display: block;text-transform: uppercase;font-weight: 500;">Payment Advice</span>
														<div style="width:30%;float:left;font-size:14px;line-height:21px;color:#000;"> 
															<p style="margin:0px 0px 0px 30px;">To:</p> 
														</div>
														<div style="width:60%;float:left;margin-right:10%;font-size:14px;line-height:21px;color:#000;">
															<p style="margin:0px;">{{@Auth::user()->company_name}}<br/>{{@Auth::user()->phone}}<br/>{{@Auth::user()->state}}<br/>{{@Auth::user()->address}} <br/>{{@Auth::user()->city}} {{@Auth::user()->zip}}<br/>AUSTRALIA</p>
														</div>
														<div style="clear:both;float:none;"></div>
													</td>
													<td style="width:50%;font-size:14px;line-height:21px;color:#000; vertical-align: top;padding-top: 20px;">
														<div style="width:100%;">
															<div style="width:50%;float:left;">
																<p style="margin:0px;"><b>Customer:</b><br/><b>Invoice Number:</b></p>
															</div>
															<div style="width:50%;float:left;">
																<p style="margin:0px;">{{@$invoicedetail->customer->title}} {{@$invoicedetail->customer->owner_name}}<br/>{{$invoicedetail->invoice}}</p>
															</div> 
															<div style="clear:both;float:none;"></div>
														</div> 
														<div style="width:100%;border-top:1px solid #ddd;"></div>
														<div style="width:100%;">
															<div style="width:50%;float:left;">
																<p style="margin:0px;"><b>Amount Due:</b><br/><b>Due Date:</b></p>
															</div>
															<div style="width:50%;float:left;">
																<p style="margin:0px;"><b>{{number_format($finaltotal,2)}}</b><br/>{{date('d M Y',strtotime($invoicedetail->due_date))}}</p>
															</div> 
															<div style="clear:both;float:none;"></div>
														</div> 
														<div style="border-top:1px solid #ddd;"></div>
														<div style="width:100%;">
															<div style="width:50%;float:left;">
																<p style="margin:0px;"><b>Amount Enclosed:</b></p>
															</div>
															<div style="width:50%;float:left;">
																<span style="display: block;height:20px;border-bottom:2px solid #ccc;"></span>
																<small style="font-size:10px;line-height:14px;color:#333;display: block;">Enter the amount you are paying above</small>
															</div> 
															<div style="clear:both;float:none;"></div>
														</div> 
													</td>
												</tr>
											</tbody>
										</table>  
									</div>
								</div>
								<div class="inv-template-footer">
									<div></div>  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="payment_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title"></h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			{{ Form::open(array('url' => 'admin/thirdparty/paymentsave', 'name'=>"add-paymentsave", 'autocomplete'=>'off', "enctype"=>"multipart/form-data", 'id'=>'updatepaymentsave')) }}
			<div class="modal-body">
				<input type="hidden" value="" name="invoice_id" id="invoice_id">
				<div class="customerror"></div>
				
					<div class="form-group row">
						<label for="subject" class="col-form-label col-sm-2">Customer Name</label>
						<div class="col-sm-10">
						<input type="text" name="" value="" disabled id="customer_name">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="amount_rec" class="col-form-label col-sm-2">Amount Received (INR)</label>
						<div class="col-sm-10">
						{{ Form::text('amount_rec', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'amount_rec' )) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="bank_charges" class="col-form-label col-sm-2">Bank Charges (if any)</label>
						<div class="col-sm-10">
						{{ Form::text('bank_charges', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'','id'=>'bank_charges' )) }}
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
						<label for="payment_date" class="col-form-label col-sm-2">Payment Date</label>
						<div class="col-sm-10">
						{{ Form::text('payment_date', date('Y-m-d'), array('class' => 'form-control commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'payment_date' )) }}
						</div>
						</div>
						<div class="col-md-6">
						<label for="payment_mode" class="col-form-label col-sm-2">Payment Mode</label>
						<div class="col-sm-10">
						<select class="form-control select2bs4" name="payment_mode">
							<option value="Cash">Cash</option>
							<option value="Bank Transfer">Bank Transfer</option>
							<option value="Bank Remittance">Bank Remittance</option>
							<option value="Check">Check</option>
							<option value="Credit Card">Credit Card</option>
						</select>
						</div>
						</div>
					</div>
					
						<div class="form-group row">
							<label for="reference" class="col-form-label col-sm-2">Reference#</label>
							<div class="col-sm-10">
							{{ Form::text('reference', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'','id'=>'reference' )) }}
							</div>
						</div>
				
						<div class="form-group">
							<label for="notes" class="col-form-label col-sm-2">Notes</label>
							<div class="col-sm-10">
							<textarea name="notes" id="notes" class="form-control" placeholder="" style="width: 100%; height:80px;padding: 10px;margin-bottom:10px;"></textarea>
							</div>
						</div>
					
					
						<div class="form-group">
							<label for="email_payment" class="col-form-label"><input checked value="1" type="checkbox" name="email_payment"> Email a "thank you" note for this payment</label>
						</div>
				
			</div>
			<div class="modal-footer justify-content-between">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="payment_save" class="btn btn-primary">Save Payment</button>
				</div>
				{{ Form::close() }}
		</div>
	</div>
</div>
<div class="modal fade" id="editpaymentmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Edit Payment</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			{{ Form::open(array('url' => 'admin/thirdparty/editpaymentsave', 'name'=>"add-paymentsave", 'autocomplete'=>'off', "enctype"=>"multipart/form-data", 'id'=>'editpaymentsave')) }}
			<div class="modal-body">
				<input type="hidden" value="" name="payment_id" id="payment_id">
				<div class="customerror"></div>
				
					<div class="form-group row">
						<label for="subject" class="col-form-label col-sm-2">Customer Name</label>
						<div class="col-sm-10">
						<input type="text" name="" value="" disabled id="customer_name">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="amount_rec" class="col-form-label col-sm-2">Amount Received (INR)</label>
						<div class="col-sm-10">
						{{ Form::text('amount_rec', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'amount_rec' )) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="bank_charges" class="col-form-label col-sm-2">Bank Charges (if any)</label>
						<div class="col-sm-10">
						{{ Form::text('bank_charges', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'','id'=>'bank_charges' )) }}
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
						<label for="payment_date" class="col-form-label col-sm-2">Payment Date</label>
						<div class="col-sm-10">
						{{ Form::text('payment_date', date('Y-m-d'), array('class' => 'form-control commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'payment_date' )) }}
						</div>
						</div>
						<div class="col-md-6">
						<label for="payment_mode" class="col-form-label col-sm-2">Payment Mode</label>
						<div class="col-sm-10">
						<select class="form-control select2bs4" id="payment_mode" name="payment_mode">
							<option value="Cash">Cash</option>
							<option value="Bank Transfer">Bank Transfer</option>
							<option value="Bank Remittance">Bank Remittance</option>
							<option value="Check">Check</option>
							<option value="Credit Card">Credit Card</option>
						</select>
						</div>
						</div>
					</div>
					
						<div class="form-group row">
							<label for="reference" class="col-form-label col-sm-2">Reference#</label>
							<div class="col-sm-10">
							{{ Form::text('reference', '', array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'','id'=>'reference' )) }}
							</div>
						</div>
				
						<div class="form-group">
							<label for="notes" class="col-form-label col-sm-2">Notes</label>
							<div class="col-sm-10">
							<textarea name="notes" id="notes" class="form-control" placeholder="" style="width: 100%; height:80px;padding: 10px;margin-bottom:10px;"></textarea>
							</div>
						</div>
				
			</div>
			<div class="modal-footer justify-content-between">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="edit_payment_save" class="btn btn-primary">Save Payment</button>
				</div>
				{{ Form::close() }}
		</div>
	</div>
</div>
<div class="modal fade" id="commenthistorymodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Comment & History</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>

			<div class="modal-body">
				
			</div>
			
		</div>
	</div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="pdfmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Print Invoice</h4>
			   <button type="button" onclick="print()" class="btn btn-primary" >
				<span aria-hidden="true">Print</span>
			  </button>
			  <button type="button" class="btn btn-default closepri">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body">
				<iframe frameborder="0" src="" style="width:100%;height:80vh;" id="myFrame" name="printframe"></iframe>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="pdfallmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Print Invoice</h4>
			   <button type="button" onclick="print()" class="btn btn-primary" >
				<span aria-hidden="true">Print</span>
			  </button>
			  <button type="button" class="btn btn-default closepri">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body">
				<iframe frameborder="0" src="" style="width:100%;height:80vh;" id="myFrame" name="printframe"></iframe>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="attach_filemodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Attach File</h4>
			  <button type="button" class="btn btn-default"  data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body">
				<div class="form-group row">
					<table id="allfiles">
					</table>
				</div>
					<div class="form-group row">
					<p>You can upload a maximum of 5 files, 5MB each</p>
					<input type="file" name="attach_file" id="attach_file" class="form-control">
					<input type="hidden" name="" id="attach_file_id" class="form-control">
				</div>
					<div class="form-group row">
					<label>Display attachment(s) emails 
					<input data-id="" class="display_attach" value="1" type="checkbox" name="is_active" data-bootstrap-switch></label>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="sharelinkmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Share Invoice Link</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>

			<div class="modal-body">
				<div class="form-group row">
					<p>Select an expiration date and generate the link to share it with your customer. Remember that anyone who has access to this link can view, print or download it.</p>
				</div>
				<div class="form-group row">
				<input type="hidden" id="invoiceid" name="invoiceid">
					<label for="expire_date" class="col-form-label col-sm-2">Link Expiration Date <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
					{{ Form::text('expire_date', date('Y-m-d', strtotime('+30 days')), array('class' => 'form-control disableifgenreate commodate', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'expire_date' )) }}
					<p><i class="fa fa-info-circle"></i> By default, the link is set to expire 30 days from the invoice due date.</p>
					</div>
				</div>
				<div class="form-group row showifgenrate" style="display:none;">
					<label for="expire_date" class="col-form-label col-sm-2">Link Expiration Date <span style="color:#ff0000;">*</span></label>
					<div class="col-sm-10">
					{{ Form::text('sharelink', '', array('class' => 'form-control', 'data-valid'=>'required', 'autocomplete'=>'off','placeholder'=>'','id'=>'sharelink' )) }}
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="share_linksave" class="btn btn-primary hideifshare">Generate Link</button>
				  <button type="button" id="share_linkdisable" class="btn btn-default hideifshare">Disable All Activate Links</button>
				  <button data-text="" type="button" id="copydata" style="display:none;" class="btn btn-primary copyboard showifgenrate">Copy Link</button>
			</div>
		</div>
	</div>
</div>
<?php
if(isset($_GET['print_invoice']) && $_GET['print_invoice'] == true){
?>
<script>
jQuery(document).ready(function($){
	var val = '{{base64_encode(convert_uuencode(@$invoicedetail->id))}}';
	$('#pdfmodel').modal('show');
		
		$("#pdfmodel .modal-body iframe").attr('src', site_url+'/admin/thirdparty/print/'+val)
});
</script>
<?php
}else if(isset($_GET['share_invoice']) && $_GET['share_invoice'] == true){
	?>
<script>
jQuery(document).ready(function($){
	var val = '{{base64_encode(convert_uuencode(@$invoicedetail->id))}}';
	$('.custom-error').remove();
		$('#sharelink').val('');
		$('.showifgenrate').hide();
		$('.hideifshare').show();
		$('.disableifgenreate').prop('disabled', false);
		$('#invoiceid').val(val);
		$('#sharelinkmodel').modal('show');
});
</script>
	<?php
}	
?>
@endsection