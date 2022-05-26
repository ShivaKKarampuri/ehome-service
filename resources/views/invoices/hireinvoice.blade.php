<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php use App\Http\Controllers\Controller; ?>
<style media="all">
	.invoice_template table.inv-itemtable tr th, .invoice_template table.inv-itemtable tr td {
    padding: 5px;}
	.invoice_template table.inv-totaltable tr td{font-size:16px;line-height:24px;padding-bottom: 5px;padding-left: 10px;color: #000;}
</style>
</head>
<body style="font-family:Arial;" class="invoice_template">
	<div style="padding: 30px 20px;">
		<div id="invoice_085" class="ember-view invoice_template">
						
							
							<style media="all">
								.invoice_template table.inv-itemtable tr th{background-color:#007bff; padding:5px 10px;color:#fff;}
								.invoice_template table.inv-itemtable tr td {padding: 5px;}
								.invoice_template table.inv-totaltable tr td:nth-child(1){ background:#bdd6ee;}
								.invoice_template table.inv-totaltable tr td:nth-child(2) {background:#deeaf6;}
								.invoice_template table.inv-totaltable tr td{font-size:12px; line-height:18px; padding-bottom: 5px;padding-left: 5px;color: #000;}
								.hire_invoice{width:100%;}
								.hire_invoice tr th, .hire_invoice tr td{font-size:13px;line-height:21px; color:#000;font-weight: normal;}
								.hire_invoice .tr_backclr th, .hire_invoice .tr_backclr td{background-color:#007bff;padding:5px 10px;color:#fff;}
							</style> 
							<div class="inv-template" style="padding:50px;">  
								<div class="inv-template-body">
									<div style="border: 1px solid #9e9e9e;" class="inv-template-bodysection">
										<table style="width: 100%;border-bottom:1px solid #000;">
											<tbody>
												<tr>
													<td style="width:50%;padding: 5px;vertical-align: top;border-right: 1px solid #000;" align="left">
														<div style="" class="invoice-logo">
									 					
															<img style="width:300px;height:200px;" src="<?php echo URL::to('/').'/public/img/sidvarlogo.jpg'; ?>" alt=""/>
															
														</div>
														<span style="display:block;font-size:13px; line-height: 18px;color: #000;margin: 12px 0px;">
															<b>Name: </b>
															<span>{{@$invoicedetail->customer->owner_name}}</span>
														</span>
														<table class="hire_invoice">
															<tbody>
																<tr class="tr_backclr">
																	<th>How to Pay</th>
																</tr>
																<tr>
																	<td>By Mail<br/>Detache This Section And Mail Your Cheque To<br/>Sidver Car Rentals<br/>1/8-10 Tullamarine Park Rd<br/>Tullamarine VIC-3043<br/>Present This Invoice at Our Office To Make Your Payment<br/>Credit Cards Payment Will Incur An Additional Surcharge of 2.5%</td>
																</tr>
															</tbody>
														</table>
													</td>	
													<td style="width:50%;padding: 5px;vertical-align: top;border-right: 1px solid #000;" align="left">
														<div style="font-size: 28px;color: #000;line-height:32px;">INVOICE</div>
														<table class="hire_invoice">
															<tbody>
																<tr>
																	<th>INVOICE</th>
																	<th>DATE</th>
																</tr>
																<tr class="tr_backclr">
																	<td>{{$invoicedetail->id}}</td>
																	<td>{{date('d M Y',strtotime($invoicedetail->invoice_date))}}</td>
																</tr>
															</tbody>
														</table>
														<table class="hire_invoice" style="margin-top:20px;margin-bottom:5px;">
															<tbody>
																<tr>
																	<th>OUR REF:</th>
																	<th>YOUR REF:</th>
																</tr>
																<tr class="tr_backclr">
																	<td>1PBSSR</td>
																	<td>AWE487</td>
																</tr>
															</tbody>
														</table>
														<table class="hire_invoice">
															<tbody>
																<tr>
																	<td><b>Electronics Fund Transfer</b></td>
																</tr>
																<tr>
																	<td>Bank: <span>CBA</span></td>
																</tr>
																<tr>
																	<td>BSB: <span>063242</span></td>
																</tr>
																<tr>
																	<td>Account Number: <span>10482336</span></td>
																</tr>
																<tr>
																	<td>Ref: <span></span></td>
																</tr>
															</tbody> 
														</table>
													</td>
												</tr>
											</tbody>
										</table>

										<div style="border-bottom:1px solid #000;">
											<table cellspacing="0" cellpadding="0" border="1" style="width: 100%;border-right:1px solid #000;" class="inv-itemtable">
												<thead>
													<tr style="font-size: 14px;line-height:18px;color:#000;">					
														<th colspan="3">Description</th>
														<th>Amount</th>
													</tr> 
												</thead>
												<tbody>
												<?php $ist = 1; $subtotal = 0; ?>
												@foreach($invoicedetail->invoicedetail as $lst)
												<?php $ntotal = $lst->quantity * $lst->rate; ?>
													<tr style="font-size: 13px;line-height:18px;color:#000;">
														<td>{{$lst->item_name}}</td>
														<td style="width:60px;"></td>
														<td style="width:60px;"></td>
														<td>$ {{number_format($ntotal,2)}}</td>
													</tr>
													<?php 
													$subtotal += $ntotal;
													$ist++; ?>
													@endforeach
												</tbody>
											</table>
										</div>
										
										<div style="clear:both;"></div>
										
										<?php if($invoicedetail->discount_type == 'fixed'){ 
											$discoun = $invoicedetail->discount;
											$finaltotal = $subtotal - $invoicedetail->discount;
										  }else{
											 $discoun = ($subtotal * $invoicedetail->discount) / 100; 
											 $finaltotal = $subtotal - $discoun;
											 
										  } 
											if(@$invoicedetail->tax != 0)
											{
												$cure = 0; 
												$taxcal = ($finaltotal * $cure) / 100;
												$finaltotal = $finaltotal + $taxcal;
											}
											
											$amount_rec = \App\HireInvoicePayment::where('invoice_id',$invoicedetail->id)->get()->sum("amount_rec");

											$ispaymentexist = \App\HireInvoicePayment::where('invoice_id',$invoicedetail->id)->exists();
											
										  ?>
										<div style="width: 100%;border-bottom: 1px solid #9e9e9e;">
											<div style="width: 50%;padding: 4px 4px 3px 7px;float: left;background: #b8d6f5;">
												<span style="font-size: 13px;line-height: 18px;display: block;text-align: center;color: #2b79c1;font-style: italic;">Thank you for your business!</span>
											</div>
											<div style="width: 50%;float:right;" class="inv-totals">
												<table style="border-left: 1px solid #9e9e9e;" class="inv-totaltable" id="itemTable" cellspacing="0" border="0" width="100%">
													<tbody>
														<tr>
															<td valign="middle">SUBTOTAL</td>
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
														<tr style="height: 15px;">
															<td></td>
															<td></td>
														</tr>
															
														<tr>
															<td valign="middle" style="color: #2b79c1;"><b>TOTAL</b></td>
															<td valign="middle"><b>{{number_format($finaltotal,2)}}</b></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div style="clear: both;"></div>
										</div>
										<div style="padding:10px;">
											<div style="font-size:14px;line-height:18px;color:#000;font-weight: 400;"><span style="display: inline-block;">Signature:</span> <span style="display: inline-block;height:20px;border-bottom:2px solid #ccc;width: 110px;"></span></div>
										</div>
										
									</div>
								</div>
								<div class="inv-template-footer">
									<div></div>  
								</div>
							</div>
						</div>
	</div>
</body>
</html>