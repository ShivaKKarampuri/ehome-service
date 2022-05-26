@extends('layouts.admin')
@section('title', 'Show Member')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Member</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Member</li>
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
								<h3 class="card-title">Personal Detail</h3>
							</div>
						  <!-- /.card-header --> 
							<div class="card-body">
								
								<div class="row">  
									
									<div class="col-sm-6">  
										<div class="form-group">  
											<label for="owner_name" class="col-form-label">Owner's Name:</label>
											<b>{{@$fetchedData->title}} {{@$fetchedData->owner_name}}</b>
										</div>
									</div>
										
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Owner's Email:</label>
											<b>{{@$fetchedData->email}}</b>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="birth_date" class="col-form-label">Date of Birth:</label>
											{{@$fetchedData->birth_date}}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="phone" class="col-form-label">Owner's Contact Details: </label>
											{{@$fetchedData->phone}}
										</div> 
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="home_contact" class="col-form-label">Home Contact:</label>
											{{@$fetchedData->home_contact}}
										</div> 
									</div>
									
								
									<div class="col-sm-6">
										<div class="form-group">
											<label for="address" class="col-form-label">Address:</label>
											<b>{{@$fetchedData->address}}</b>
										</div>  
									</div> 
									<div class="col-sm-6">
										<div class="form-group">
											<label for="address" class="col-form-label">ABN:</label>
											<b>{{@$fetchedData->abn}}</b>
										</div>  
									</div> 
									
									
								</div> 
								
							</div> 
						</div>	
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">License Detail</h3>
							</div>
						  <!-- /.card-header --> 
							<div class="card-body">
								
								<div class="row">  
									
									<div class="col-sm-6">  
										<div class="form-group">  
											<label for="owner_name" class="col-form-label">License Number:</label>
											<b>{{@$fetchedData->license}} </b>
										</div>
									</div>
										
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">License Expiry:</label>
											<b>{{@$fetchedData->license_expire}}</b>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="birth_date" class="col-form-label">Licence Front</label>
											<?php if($fetchedData->licence_front != ''){ ?>
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_front}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="birth_date" class="col-form-label">Licence Back</label>
											<?php if($fetchedData->licence_back != ''){ ?>
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->licence_back}}"><img src="{{URL::to('/public/img')}}/placeholder-42146dee.png" width="100" height="100"></a>
										<?php } ?>
										</div>
									</div>
									
								</div> 
								
							</div> 
						</div>	
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Credit Card Detail</h3>
							</div>
						  <!-- /.card-header --> 
							<div class="card-body">
								
								<div class="row">  
									
									<div class="col-sm-6">  
										<div class="form-group">  
											<label for="owner_name" class="col-form-label">CreditCard Type:</label>
											<b>{{@$fetchedData->card_type}} </b>
										</div>
									</div>
										
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Name:</label>
											<b>{{@$fetchedData->card_name}}</b>
										</div>
									</div>
									
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Card Number:</label>
											<b>{{@$fetchedData->card_no}}</b>
										</div>
									</div>
									
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Expiration Date:</label>
											<b>{{@$fetchedData->expire_date}}</b>
										</div>
									</div>
									
									<div class="col-sm-6">	
										<div class="form-group"> 
											<label for="email" class="col-form-label">Security Code:</label>
											<b>{{@$fetchedData->cvv}}</b>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"> 
											<label for="birth_date" class="col-form-label">Credit Card Agreement</label>
											<?php if($fetchedData->agreement != ''){ ?>
											
											<a target="_blank" href="{{URL::to('/public/img/licence')}}/{{$fetchedData->agreement}}">View Aggrement</a>
										<?php } ?>
										</div>
									</div>
									
								</div> 
								
							</div> 
						</div>	
					</div>
				</div>
		</div>
	</section>
</div>
@endsection