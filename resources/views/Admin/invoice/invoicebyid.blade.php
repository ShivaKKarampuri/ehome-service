<?php use App\Http\Controllers\Controller; ?>
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
								<a href="{{URL::to('/admin/invoice/edit/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}" class="btn btn-inline-block btn-sm cus_btn"><i class="fa fa-edit"></i> Edit</a>  
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> Mail <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/invoice/email/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">Send Mail</a>
									</div> 
								</div>
								
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> PDF / Print <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/invoice/download/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">PDF</a>
									  <a class="dropdown-item print_invoice" tabindex="-1" dataid="{{base64_encode(convert_uuencode(@$invoicedetail->id))}}" href="javascript:;">Print</a>
									</div> 
								</div>
								<div class="more_btn_group">
									<a class="dropdown-toggle btn btn--inline-block btn-sm cus_btn" data-toggle="dropdown" href="#" aria-expanded="false">
									 <i class="fa fa-envelop-o"></i> Reminders <span class="caret"></span>
									</a>
									<div class="dropdown-menu" x-placement="top-start">
									  <a class="dropdown-item" tabindex="-1" href="{{URL::to('/admin/invoice/reminder/'.base64_encode(convert_uuencode(@$invoicedetail->id)))}}">Send Now</a>
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
						<?php $currencydata = \App\Currency::where('id',$invoicedetail->currency_id)->first(); ?>
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
						<?php
$today = date('Y-m-d');						
						
						if(strtotime($today) > strtotime($invoicedetail->due_date) && $invoicedetail->status != 1){
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
														<td>FULL COMPREHENSIVE INSURANCE COVER STARTS FOR THE PERIOD FROM <?php echo date('d/m/Y', strtotime($invoicedetail->invoice_date)); ?> TILL <?php echo date('Y-m-d', strtotime("+12 months", strtotime($invoicedetail->invoice_date))); ?>, AS YOU ARE ON {{$lst->item_name}} INSTALMENT PLAN PLEASE PAY ACCORDINGLY.</td>
				<td>{{number_format($lst->quantity,2)}}</td>
				<?php
					$tp = $lst->rate / 11;
					$exgst = $lst->rate - $tp;
				?>
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
										
										<?php if($invoicedetail->discount_type == 'fixed'){ 
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
										<div style="width: 100%;border-bottom: 1px solid #9e9e9e;">
											<div style="width: 50%;padding: 4px 4px 3px 7px;float: left;">
											</div>
											<div style="width: 43.6%;float:right;" class="inv-totals">
												<table style="border-left: 1px solid #9e9e9e;" class="inv-totaltable" id="itemTable" cellspacing="0" border="0" width="100%">
													<tbody>
														<tr>
															<td valign="middle">Sub Total</td>
															<td valign="middle">{{number_format($subtotal,2)}}</td>
														</tr>
														<?php 
														
														  if($invoicedetail->discount != 0){
														?>
														<tr>
														<td>Discount(<?php if($invoicedetail->discount_type == 'fixed'){ echo '$'; } ?>{{$invoicedetail->discount}} <?php if($invoicedetail->discount_type == 'percentage'){ echo '%'; } ?>)</td>
														<td id="tmp_total" valign="middle" style="width:110px;">(-) <?php echo $discoun; ?></td>
														</tr>
														  <?php } ?>
												 		
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