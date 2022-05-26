@extends('layouts.admin')
@section('title', 'Edit Amenities')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
		{{ Form::open(array('url' => 'admin/amenities/edit', 'name'=>"edit-category", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
					{{ Form::hidden('id', @$fetchedData->id) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
						<span class="custom-error-msg"></span> 
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
					
						<div class="card-header"> 
							<h4>Edit Amenities</h4>
						</div>
						<div class="card-body">
						
							<div class="form-group">
								<label>Name</label>
								<input type="text" value="<?php echo @$fetchedData->title; ?>" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							
							
						</div>
						
					
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
					<div class="card">
						<div class="card-header"> 
							<h4>Publish</h4>
						</div>
						<div class="card-body"> 
							
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('edit-category')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
					
				</div>              
            </div>
		</div>
		{{ Form::close() }}
	</section> 
</div>

@endsection