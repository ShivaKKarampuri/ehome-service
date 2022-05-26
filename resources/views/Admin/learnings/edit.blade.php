@extends('layouts.admin')
@section('title', 'Edit Learning Steps')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/learning/edit', 'name'=>"edit-learning", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
							<h4>Edit Learning Steps</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="title" data-valid="required" class="form-control" value="<?php echo @$fetchedData->title; ?>"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea id="editor1" name="description" placeholder="Description" class="summernote-simple"><?php echo @$fetchedData->description; ?></textarea>
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
									<option value="1" @if(@$fetchedData->status == 1) selected  @endif>Publish</option>
									<option value="0" @if(@$fetchedData->status == 0) selected  @endif>Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.learning.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('edit-learning')" class="btn btn-success pull-right">Update</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<input type="hidden" id="old_image" name="old_image" value="{{@$fetchedData->image}}" />
											
								<input type="file" name="image" class="form-control" autocomplete="off" data-valid="" />									
								<div class="show-uploded-img">	
									@if(@$fetchedData->image != '')
										<img width="70" src="{{URL::to('/public/img/cmspage')}}/{{@$fetchedData->image}}" class="img-avatar"/>
									@endif
								</div>							
															
								@if ($errors->has('image'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('image') }}</strong>
									</span> 
								@endif
							</div>
						</div> 
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection