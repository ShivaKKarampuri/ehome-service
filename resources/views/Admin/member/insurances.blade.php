@extends('layouts.admin')
@section('title', 'Insurances')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Insurances</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Insurances</li>
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
								
							</div> 
							<div class="card-tools card_tools">
								<form action="{{route('admin.insurances')}}">
								<div class="row">
									<div class="col-md-6">
										<select class="form-control" name="type">
											<option value="all" @if(@$_GET['type'] == 'all') selected @endif>All</option>
											<option value="0" @if(@$_GET['type'] == '0') selected @endif>Pending</option>
											<option value="1" @if(@$_GET['type'] == '1') selected @endif>Active</option>
											<option value="3" @if(@$_GET['type'] == '3') selected @endif>Canceled</option>
										</select>
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
										
									</div>
									@if(isset($_GET['type']))
									<div class="col-md-3">
										
										
										<a style="margin-left: 4px;" class="btn btn-primary" href="{{route('admin.insurances')}}">Reset</a>
									
									</div>
									@endif
								</div>
								
								</form>
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
							  <thead>
								<tr>
								  
								  <th>Customer Name</th>
								  <th>Vehicle Reg No</th>
								  <th>Policy Number</th>
								  <th>Insurance date</th>
								  <th>Period</th>
								  <th>Total Premium</th>
								  <th>Amount</th>
								  <th>Status</th>
								</tr>  
							  </thead> 
							  <tbody class="tdata">	
							   @if(@$totalData !== 0)
								@foreach (@$lists as $list)	
								<tr id="id_{{@$list->id}}"> 
								 <td>  
								<a href="{{URL::to('/admin/member/show/'.base64_encode(convert_uuencode(@$list->customer_id)))}}">{{ @$list->customer->title }}  {{ @$list->customer->owner_name == "" ? config('constants.empty') : str_limit(@$list->customer->owner_name, '50', '...') }}</a>
								 </td> 
								  <td>{{ @$list->vehicle->vehicle_registration }}</td> 
								  <td>AUS{{ @$list->policy_number}}</td>
								  <td>{{ @$list->insurance_date}}</td>
								  <td>{{ @$list->plan_id}}</td>
								  <td>{{ @$list->amount}}</td>
								  <td>{{ @$list->pay_amount}}</td>
								 <td><?php if($list->status == 1){
									echo 'Active';  
								  }else if($list->status == 3){ echo 'Canceled'; }else{ echo 'Pending'; } ?></td>
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
							   {!! $lists->appends(\Request::except('page'))->render() !!}   
							 </div> 
						  </div>
					</div>	
				</div>	
			</div>
		</div>
	</section>
</div>
@endsection