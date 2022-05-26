@extends('layouts.admin')
@section('title', 'Amenities')

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
				<div class="col-5 col-md-5 col-lg-5">
					<div class="card">
					{{ Form::open(array('url' => 'admin/amenities/store', 'name'=>"add-category", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
						<div class="card-header"> 
							<h4>Add Amenities</h4>
						</div>
						<div class="card-body">
						
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							
						</div>
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('add-category')" class="btn btn-success pull-right">Submit</button>
						</div>
						{{ Form::close() }}
					</div>
				</div>
				<div class="col-7 col-md-7 col-lg-7">
					<div class="card">
						<div class="card-header"> 
							<h4>Amenities</h4>
							<div class="mr_left_auto">
								 <form>
									  <div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<div class="input-group-btn">
										  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
										</div>
									  </div>
									</form>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped">
									
										<tr>
										  <th>Name</th>
										 
										  <th>Action</th>
										</tr>
									
									@if(@$totalData !== 0)
									
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}">
										  <td>{{ @$list->title == "" ? config('constants.empty') : str_limit(@$list->title, '50', '...') }}</td>
										 
										  <td>
										  <a href="{{URL::to('/admin/amenities/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-outline-primary">Edit</a>  
										  <!--<a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'categories')" class="btn btn-outline-primary">Delete</a>  -->
										  
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