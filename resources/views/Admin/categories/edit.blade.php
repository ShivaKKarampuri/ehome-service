@extends('layouts.admin')
@section('title', 'Edit Category')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
		{{ Form::open(array('url' => 'admin/categories/edit', 'name'=>"edit-category", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
							<h4>Edit Category</h4>
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
							<div class="form-group">
								<label>Parent</label>
								<select class="form-control" name="parent">
									<option value="0">None</option>
										<?php
											echo \App\Category::printTree($tree, 0, null, @$fetchedData->parent);
										?>
								</select>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" data-valid="" class="form-control">{{@$fetchedData->description}}</textarea>
								@if ($errors->has('description'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('description') }}</strong>
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
									<option value="1" @if(@$fetchedData->status == 1) selected  @endif>Publish</option>
									<option value="0" @if(@$fetchedData->status == 0) selected  @endif>Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('edit-category')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Image</label>
								<input type="file" name="profile_img" class="form-control" />
								<input type="hidden" name="old_profile_img" value="<?php echo @$fetchedData->image; ?>">
								<?php if($fetchedData->image != ''){ ?>
								
								<img src="{{URL::to('/public/img/category_imgs')}}/{{$fetchedData->image}}" width="100" height="100">
								<?php } ?>
							</div>
						</div> 
					</div>
				</div>              
            </div>
		</div>
		{{ Form::close() }}
	</section> 
</div>

@endsection