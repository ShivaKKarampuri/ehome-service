@extends('layouts.admin')
@section('title', 'Documents')

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
					<h1 class="m-0 text-dark">Documents</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Documents</li>
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
								<h4> Documents History</h4>
							</div> 
							
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
							  <thead>
								<tr>
							
								  <th>Document</th>
								 

								</tr>  
							  </thead> 
							  <tbody class="tdata">	
							   @if(@$totalData !== 0)
								@foreach (@$lists as $list)	
								
								<tr id="id_{{@$list->id}}"> 
								  <td><a target="_blank" href="{{URL::to('/public/img/attach_files')}}">{{@$list->name}}</a></td> 
								 
								
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