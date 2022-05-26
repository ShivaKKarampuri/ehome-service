@extends('layouts.admin')
@section('title', 'Traning Create')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	 <section class="content-header">
      <h1>Traning<small>Create</small></h1>
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/admin/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{URL::to('/admin/traning')}}">Traning Steps</a></li>
        <li class="active">Create</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
	{{ Form::open(array('url' => 'admin/hire-car/store', 'name'=>"add-hirecar", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
		<div class="row">
			<div class="col-md-9">
				<!-- Flash Message Start -->
				<div class="server-error">
					@include('../Elements/flash-message')
				</div>
				<!-- Flash Message End -->
				<div class="box box-success">
					 <div class="box-header with-border">
						<h3 class="box-title">Create Traning</h3>
					 </div>
					 <div class="box-body">
						 <div class="form-group">
							<label for="exampleInputTitle1">Title</label>
							<input type="text" class="form-control" id="exampleInputTitle1" name="title" placeholder="Enter Title">
							@if ($errors->has('title'))
							<span class="custom-error" role="alert">
								<strong>{{ @$errors->first('title') }}</strong>
							</span> 
						@endif
						</div>
						 <div class="form-group">
							<textarea id="editor1" name="description" placeholder="Description" rows="10" cols="80"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputTitle1">Video</label>
							<input type="file" name="video" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-success">
					<div class="box-header with-border">
					  <h3 class="box-title">Publish</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Status</label>
							  <select name="status" class="form-control">
								<option value="1">Publish</option>
								<option value="0">Draft</option>
							</select>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-default">Cancel</button>
						<button type="submit" class="btn btn-info pull-right">Save</button>
					</div>
				</div>
				<div class="box box-success">
					<div class="box-header with-border">
					  <h3 class="box-title">Image</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<input type="file" name="image" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</section>
</div>
@endsection
@section('scripts')
<script>
$(function () {
	CKEDITOR.replace('editor1');
});
</script>
@endsection