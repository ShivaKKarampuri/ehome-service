@extends('layouts.admin')
@section('title', 'Ads Listing')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
						<span class="custom-error-msg"></span> 
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header"> 
							<h4>Ads Listing</h4>
							<div class="mr_left_auto">
							<?php
							$countall = \App\MyAd::where('id', '!=', '')->count();
							$counttrash = \App\MyAd::where('type', '=', 'trash')->count();
							?>
								<a href="{{URL::to('admin/ads')}}">All ({{$countall}})</a> | 
								<a href="{{URL::to('admin/ads')}}?type=trash">Trash ({{$counttrash}})</a>
							</div>
						</div>
						<div class="card-body">
						{{ Form::open(array('name'=>"search-form", 'method' => 'get', 'autocomplete'=>'off')) }}
						<?php
						$type = isset($_GET['type']) ? $_GET['type'] : 'publish';
						if($type == 'trash'){
							?>
							<input type="hidden" value="trash" name="type">
							<?php
						}
						?>
							<div class="row">
								<div class="col-4 col-md-4 col-lg-4">
										<div class="form-group">
											<label>Category</label>
											<?php
												$category = Request::get('category');
												?>
											<select onchange="myChildFunction()" id="category" class="form-control" name="category" data-valid="required">
												<option value="">Select category</option>
												@foreach (\App\Category::where('parent', 0)->get() as $pt_cat)
													<option value="{{ @$pt_cat->id }}" @if($category == @$pt_cat->id) selected @endif>{{ @$pt_cat->title }}</option>
												@endforeach									
											</select>
										</div>
									</div>
									<?php
												$sub_category = Request::get('sub_category');
												?>
									<div class="col-4 col-md-4 col-lg-4">
										<div class="form-group">
											<label>Sub Category</label>
											<select id="sub_category" class="form-control" name="sub_category" data-valid="required">
												<option value="">Select Subcategory</option>
											@foreach (\App\Category::where('parent', $category)->get() as $st_cat)
													<option value="{{ @$st_cat->id }}" @if($sub_category == @$st_cat->id) selected @endif>{{ @$st_cat->title }}</option>
												@endforeach	
											</select>
											
										</div>
									</div>
									<?php
									$status = Request::get('status');
									?>
									<div class="col-4 col-md-4 col-lg-4">
										<div class="form-group">
											<label>Status</label>
											<select id="status" class="form-control" name="status" data-valid="required">
												<option value="">Select</option>
												<option value="active" @if($status == 'active') selected @endif>Active</option>
												<option value="inactive" @if($status == 'inactive') selected @endif>Inactive</option>
											</select>
										</div>
									</div>
									<div class="col-4 col-md-4 col-lg-4">
										<button type="submit" class="btn btn-success">Submit</button>
										<a href="{{URL::to('admin/ads')}}" class="btn btn-danger"><i data-feather="rotate-cw"></i></a>
									</div>
								</div>
								{{ Form::close() }}
							<div class="table-responsive m-t-15">
								<table class="table table-striped">
									
										<tr>
										  <th>Title</th>
										 <!-- <th>Category</th>
										  <th>Sub Category</th>-->
										  <th>Price</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr>
									
									@if(@$totalData !== 0)
									
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}">
										  <td>{{ @$list->title == "" ? config('constants.empty') : str_limit(@$list->title, '50', '...') }}</td>
										 <!-- <td>{{@$list->categorydata->title }}</td>
										  <td>{{@$list->subcategorydata->title }}</td>-->
										  <td>{{ @$list->price }}</td>
										  <td>
											@if(@$list->status == 1)
											<div class="badge badge-success">Active</div>
											@else
											<div class="badge badge-danger">InActive</div>
											@endif
										  </td>
										  <td>
										  <a href="{{URL::to('/admin/ads/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-outline-primary">Edit</a>  
										  <a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'my_ads')" class="btn btn-outline-primary">Delete</a>  
										  
										</tr>
										@endforeach 
									
									@else
									
										<tr>
											<td colspan="6">
												{{config('constants.no_data')}}
											</td>
										</tr>
									
									@endif
								</table>
							</div>
						</div>
						<!--<div class="card-footer text-right">
							<nav class="d-inline-block">
								<ul class="pagination mb-0">
									<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a></li>
									<li class="page-item active"><a class="page-link" href="#">1 	<span class="sr-only">(current)</span></a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
								</ul>
							</nav>
						</div>-->
					</div>
				</div>              
            </div>
		</div>
	</section> 
</div>

@endsection