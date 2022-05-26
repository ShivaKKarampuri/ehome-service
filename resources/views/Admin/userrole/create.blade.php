@extends('layouts.admin')
@section('title', 'Create User Role')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/userrole/store', 'name'=>"add-userrole", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add User Role</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>User Role Type</label>
								<select name="usertype" id="usertype" class="form-control" autocomplete="new-password" data-valid="required">
									<option value="">Choose One...</option>
									@if(count(@$usertype) !== 0)
										@foreach (@$usertype as $ut)
											<option value="{{ @$ut->id }}">{{ @$ut->name }}</option>
										@endforeach
									@endif		
								</select>
								@if ($errors->has('usertype'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('usertype') }}</strong>
									</span> 
								@endif
							</div> 
							<div class="form-group">
								<label>Add User Role</label>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" name="module_access[]" id="user_management" value="user_management">
									<label for="user_management" class="custom-control-label">User Management</label>
								</div> 
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" name="module_access[]" id="user_role" value="user_role">
									<label for="user_role" class="custom-control-label">User Role</label>
								</div>
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
							<button type="button" onClick="customValidate('add-company')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection