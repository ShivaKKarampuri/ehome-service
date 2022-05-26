@extends('layouts.admin')
@section('title', 'Traning')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	 <section class="content-header">
      <h1>
        Traning
        <small>Lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/admin/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Traning</li>
      </ol>
    </section>
	 
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Traning</h3>
						<div class="box-tools">
							<a href="{{route('admin.traning.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Traning</a> 
						</div>
					</div>
					 <div class="box-body">
						<table class="table table-bordered">
							<tr>
							  <th>#</th>
							  <th>Title</th>
							   <th>Action</th>
							</tr>
							
						  </table>
					 </div>
				</div>
			</div>
		</div>
		
	</section>
</div>
@endsection