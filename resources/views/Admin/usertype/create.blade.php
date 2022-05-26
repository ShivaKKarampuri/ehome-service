@extends('layouts.admin')
@section('title', 'Create User Type')

@section('content')

<div class="main-content"> 
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/usertype/store', 'name'=>"add-usertype", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>   
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add User Type</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>User Role Type</label>								
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
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('add-usertype')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection