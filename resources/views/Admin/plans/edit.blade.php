@extends('layouts.admin')
@section('title', 'Edit Plans')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Plans</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Plans</li>
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
			<!-- form start -->
			{{ Form::open(array('url' => 'admin/plans/edit', 'name'=>"edit-plans", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			{{ Form::hidden('id', @$fetchedData->id) }}
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Edit Plans</h3>
							</div>
						  <!-- /.card-header --> 
							<div class="card-body">
								<div class="form-group" style="text-align:right;">
									<a style="margin-right:5px;" href="{{route('admin.plans.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
									{{ Form::button('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("edit-plans")' ]) }}
								</div>
								<div class="row"> 
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="plan_name" class="col-form-label">Plans</label>
											<select class="form-control" name="plan_name">
												<option value="Monthly" @if($fetchedData->plan_name == 'Monthly') selected @endif>Monthly</option>
												<option value="Thrice" @if($fetchedData->plan_name == 'Thrice') selected @endif>Thrice</option>
												<option value="Twice" @if($fetchedData->plan_name == 'Twice') selected @endif>Twice</option>
												<option value="Yearly" @if($fetchedData->plan_name == 'Yearly') selected @endif>Yearly</option>
											</select> 
											@if ($errors->has('plan_name'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('plan_name') }}</strong>
												</span> 
											@endif
										</div>
									</div> 
									<div class="col-sm-6">
										<div class="form-group">  
											<label for="price" class="col-form-label">Price</label>
											{{ Form::text('price', @$fetchedData->price, array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','placeholder'=>'Price' )) }}
											@if ($errors->has('price'))
												<span class="custom-error" role="alert">
													<strong>{{ @$errors->first('price') }}</strong>
												</span> 
											@endif
										</div>
									</div>
								</div> 
								<div class="row">	
									<div class="col-md-12">  
										<div style="margin-bottom:0px;" class="float-right form-group">
											{{ Form::button('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-primary', 'onClick'=>'customValidate("edit-plans")' ]) }}
										</div>
									</div>	  
								</div>
							</div> 
						</div>	
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
<script>
jQuery(document).ready(function($){
	$('#select_country').attr('data-selected-country','<?php echo @$fetchedData->country; ?>');
		$('#select_country').flagStrap();
});
</script>
@endsection