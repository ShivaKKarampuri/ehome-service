@extends('layouts.admin')
@section('title', 'Users')

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
							<h4>Users</h4>
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
										  <th>Email</th>
										  <th>Username</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr>
									
									@if(@$totalData !== 0)
									
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}">
										  <td>{{ @$list->first_name == "" ? config('constants.empty') : str_limit(@$list->first_name, '50', '...') }} {{ @$list->last_name == "" ? config('constants.empty') : str_limit(@$list->last_name, '50', '...') }}</td>
										  <td>{{ @$list->email == "" ? config('constants.empty') : str_limit(@$list->email, '50', '...') }}</td>
										  <td>{{ @$list->username == "" ? config('constants.empty') : str_limit(@$list->username, '50', '...') }}</td>
										  <td>
											@if(@$list->status == 1)
											<div class="badge badge-success">Active</div>
											@else
											<div class="badge badge-danger">InActive</div>
											@endif
										  </td>
										  <td>
										  <a href="{{URL::to('/admin/users/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-outline-primary">Edit</a>  
										  <a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'admins')" class="btn btn-outline-primary">Delete</a>  
										  
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