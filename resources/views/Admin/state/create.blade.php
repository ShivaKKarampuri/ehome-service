@extends('layouts.admin')
@section('title', 'State')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/state/store', 'name'=>"add-state", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add State</h4>
						</div>
						<div class="card-body"> 							 
							<div class="form-group">
								<label>Country</label>
								<select id="country" class="form-control" name="country_id" data-valid="required">   
								<option value="">Select Country</option>
									@foreach (\App\Country::all() as $cntry)
									<option value="{{ @$cntry->id }}">{{ @$cntry->name }}</option>
									@endforeach									
								</select>
								@if ($errors->has('country_id'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('country_id') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="name" data-valid="required" class="form-control"/>
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
							<a style="margin-right:5px;" href="{{route('admin.state.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('add-state')" class="btn btn-success pull-right">Save</button>
						</div>
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection