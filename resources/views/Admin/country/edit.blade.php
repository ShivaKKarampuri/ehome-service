@extends('layouts.admin')
@section('title', 'Edit Country')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/country/edit', 'name'=>"edit-country", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			 {{ Form::hidden('id', @$fetchedData->id) }}  
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Edit Country</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="name" data-valid="required" class="form-control" value="<?php echo @$fetchedData->name; ?>"/>
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
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
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.country.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('edit-country')" class="btn btn-success pull-right">Update</button>
						</div>
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection