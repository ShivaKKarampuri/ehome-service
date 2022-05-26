@extends('layouts.admin')
@section('title', 'Payments')

@section('content')
<?php
//echo '<pre>'; print_r($lists);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Payments</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Payments</li>
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
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">  
							<div class="card-title">
								<h4><?php echo $lists[0]->customer->owner_name; ?> Payments History</h4>
							</div> 
							<div class="card-tools card_tools">
								<div class="input-group input-group-sm" style="width: 150px;">
									<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
									</div>
								</div> 
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
							  <thead>
								<tr>
							
								  <th>Policy number</th>
								  <th>Insurance date</th>
								  <th>Invoice date</th>
								  <th>Invoice</th>
								  <th>Amount</th>
								  <th>Pay Amount</th>
								  <th>Pending Amount</th>
								  <th>Due Date</th>
								  <th>Payment Status</th>
								  <th>Action</th>

								</tr>  
							  </thead> 
							  <tbody class="tdata">	
							   @if(@$totalData !== 0)
								@foreach (@$lists as $list)	
								<?php 
								$pay = 0;
									foreach($list->invoicepayment as $lis){
										$pay += $lis->amount_rec;
									}
								?>
								<tr id="id_{{@$list->id}}"> 
								  <td>{{@$list->insuracedetail->policy_number}}</td> 
								  <td>{{@$list->insuracedetail->insurance_date}}</td>
								  <td>{{@$list->invoice_date}}</td>
								  <td><a href="{{URL::to('/admin/invoice/lists/'.base64_encode(convert_uuencode(@$list->id)))}}">{{@$list->invoice}}</a></td>
								  <td>${{@$list->amount}}</td>
								    <td>${{@$pay}}</td>
								    <td>${{@$list->amount - @$pay}}</td>
								  <td>{{@$list->due_date}}</td>
								
								  <td><?php
								  $today = date('Y-m-d');
										$count = 2;
										$datetime1 = new DateTime($today);
										$datetime2 = new DateTime($list->due_date);
										$interval = $datetime1->diff($datetime2);
										$diff = $interval->format('%a');
										if(strtotime($today) > strtotime($list->due_date) && $list->status != 1){
											echo '<span class="float-right text-overdue text-uppercase">OVERDUE BY '.$diff.' DAYS</span>';
										}else{	
											if($list->status == 1){
												echo '<span class="float-right text-accepted text-uppercase">Paid</span>';
											}else if($list->status == 2){
												echo '<span class="float-right text-sent text-uppercase">Pending</span>';
											}else if($list->status == 3){
												echo '<span class="float-right text-accepted text-uppercase">Partially Paid</span>';
											}else{
												echo '<span class="float-right text-sent text-uppercase">Draft</span>';
											}
										}
									?></td>
								 <td>
									<a href="{{URL::to('/admin/member/document-history/'.base64_encode(convert_uuencode(@$list->id)))}}"> Documents History</a> 
								  </td>
								
								</tr>	
							  @endforeach 
									
							  </tbody>
							    @else
							  <tbody>
									<tr>
										<td style="text-align:center;" colspan="6">
											No Record found
										</td>
									</tr>
								</tbody>
							  @endif 
							</table> 
							<div class="card-footer">
							   {{ $lists->appends(\Request::except('page'))->render() }}   
							 </div> 
						  </div>
					</div>	
				</div>	
			</div>
		</div>
	</section>
</div>
@endsection