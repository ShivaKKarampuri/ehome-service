@extends('layouts.admin')
@section('title', 'Customer')

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
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">  
							<div class="card-title">
								<a href="{{route('admin.hirecustomer.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Customer</a>
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
								  <th>Invoice</th>
								  <th>Amount</th>
								  <th>Hire Date</th>
								  <th>Drop Date</th>
								  <th>Invoice Date</th>
								  <th class="no-sort">Action</th>
								</tr>  
							  </thead> 
							  <tbody class="tdata">	
							   @if(@$totalData !== 0)
								@foreach (@$lists as $list)	
								<tr id="id_{{@$list->id}}"> 
									<td>{{$list->id}}</td> 
									<td>{{number_format($list->amount, 2)}}</td> 
									<td>{{date('d/m/Y',strtotime($list->hire_date))}}</td> 
								   <td>{{date('d/m/Y',strtotime($list->drop_date))}}</td> 
									<td>{{date('d/m/Y',strtotime($list->invoice_date))}}</td> 
									 <td> 
									<a href="{{URL::to('/admin/hire-invoice/lists/'.base64_encode(convert_uuencode(@$list->id)))}}">View History</a> 
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