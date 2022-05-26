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
				<div class="col-md-12">
					<div class="card"> 
						<div class="card-header">   
							<div class="card-title">
								<a href="{{route('admin.claim.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Accident Claim Form</a> 
							</div> 
							<div class="card-tools card_tools">
								<form action="{{route('admin.claim.index')}}">
								<div class="input-group input-group-sm" style="width: 250;">
								
									<input type="text" name="s" class="form-control float-right" value="{{@$_GET['s']}}" placeholder="Search">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
									</div>
									@if(isset($_GET['s']))
										<a style="margin-left: 4px;" class="btn btn-primary" href="{{route('admin.claim.index')}}">Reset</a>
									@endif
									
								</div>
								</form>
							</div>
						</div>    
						<div class="card-body table-responsive">
							<table id="hirecartable" class="table table-bordered table-hover text-nowrap">
							  <thead>
								<tr> 
								  <th class="no-sort"><input type="checkbox" id="checkedAll"></th>
								  <th>Customer Name</th>
								  <th>Rego Number</th>
								  <th>Date of Accident</th>
								  <th>Claim</th>  
								  <th>Assessment Report</th>
								  <th>Pay Slips</th>
								  <th>Hire Car Agreement</th>
								  <th>Hire Car Invoice</th>
								  <th>Rego Paper</th>
								  <th>Repair Invoice</th>
								  <th class="no-sort">Action</th>
								</tr> 
							  </thead> 
								<tbody class="tdata">	
								@if(@$totalData !== 0)
								
								@foreach (@$lists as $list)	
							
									<tr id="id_{{@$list->id}}"> 
										<td><input class="checkSingle" type="checkbox" name="allcheckbox" value="{{@$list->id}}"></td>	
										<td>{{ @$list->customer->owner_name }}</td> 
										<td>{{ @$list->rego_no }}</td> 
										<td>{{ @$list->date_of_accident }}</td> 
										<td>{{ @$list->claim == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->assessment_report == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->payslip == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->hirecar_agreement == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->hirecar_invoice == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->rego_paper == 1 ? 'Yes' : 'No' }}</td> 
										<td>{{ @$list->repair_invoice == 1 ? 'Yes' : 'No' }}</td> 
										<td> 
											<div class="nav-item dropdown action_dropdown">
												<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
												<div class="dropdown-menu">
													<a href="{{URL::to('/admin/claim/edit/'.base64_encode(convert_uuencode(@$list->id)))}}"><i class="fa fa-edit"></i> Edit</a>
													<a href="javascript:;" onClick="deleteAction({{@$list->id}}, 'claims')"><i class="fa fa-trash"></i> Delete</a>
												</div> 
											</div>  
										</td>  
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
							<div class="card-footer hide">
							{{-- {!! $lists->appends(\Request::except('page'))->render() !!} --}}
							 </div>
						  </div>
					</div>	
				</div>	
			</div>
		</div>
	</section>
</div>
@endsection