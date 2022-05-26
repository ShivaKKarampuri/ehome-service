@extends('layouts.admin')
@section('title', 'Insurance')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Insurance</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Insurance</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->	
	<!-- Breadcrumb start-->
	<!--<ol class="breadcrumb">
		<li class="breadcrumb-item active">
			Home / <b>Dashboard</b>
		</li>
		@include('../Elements/Admin/breadcrumb')
	</ol>-->
	<!-- Breadcrumb end-->
	
	<!-- Main content --> 
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Flash Message Start -->
					<div class="server-error">
						@include('../Elements/flash-message')
					</div>
					<!-- Flash Message End -->
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">  
							<div class="card-title">
								<h4><?php echo $lists[0]->customer->owner_name; ?> Insuranse History</h4>
							</div> 
							<div class="card-tools card_tools">
								<div class="input-group input-group-sm" style="width: 150px;">
									<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
									</div>
								</div> 
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
							  <thead>
								<tr>
							
								  <th>Policy number</th>
								  <th>Insurance date</th>
								  <th>Valid date</th>
								  <th>Next Payment date</th>
								  <th>Total Premium</th>
								 
								  <th>Plan</th>
								  <th>Payable Amount</th>
								  <th>Status</th>
								  <th>Action</th>
								</tr>  
							  </thead> 
							  <tbody class="tdata">	
							   @if(@$totalData !== 0)
								@foreach (@$lists as $list)	
								<tr id="id_{{@$list->id}}"> 
								  <td><a class="print_insurance" tabindex="-1" dataid="{{base64_encode(convert_uuencode(@$list->id))}}" href="javascript:;" style="color: #0080ec;">AUS{{@$list->policy_number}}</a></td> 
								  <td>{{@$list->insurance_date}}</td> 
								  <td>{{@$list->valid_date}}</td>
								  <td>{{@$list->next_date}}</td>
								  <td>${{@$list->amount}}</td>
								  <td>{{@$list->plan_id}}</td>
								  <td>${{@$list->pay_amount}}</td>
								  <td><?php if($list->status == 1){
									echo 'Active';  
								  }else if($list->status == 3){ echo 'Canceled'; }else{ echo 'Pending'; } ?></td>
								
								  <td>
									<a href="{{URL::to('/admin/member/payment-history/'.base64_encode(convert_uuencode(@$list->id)))}}"><i class="fa fa-edit"></i> Insurance History</a> /
									@if($list->status == 3)
									<a style="color: #58b33a;" href="javascript:;" dataid="{{@$list->id}}" class="activeins"><i class="fa fa-check"></i> Activate</a> 
								@else
									<a style="color: #ff0000;" href="javascript:;" dataid="{{@$list->id}}" class="cancelins"><i class="fa fa-remove"></i> Cancel</a> 
									
									@endif
								  </td> 
								</tr>	
							  @endforeach 
									
							  </tbody>
							    @else
							  <tbody>
									<tr>
										<td style="text-align:center;" colspan="9">
											No Record found
										</td>
									</tr>
								</tbody>
							  @endif 
							</table>  
							<div class="card-footer" style="display:none;">
							{{--  {{ $lists->appends(\Request::except('page'))->render() }}   --}}
							 </div> 
						  </div>
					</div>	
				</div>	
			</div>
		</div>
	</section>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="pdfmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Print Invoice</h4>
			   <button type="button" onclick="print()" class="btn btn-primary" >
				<span aria-hidden="true">Print</span>
			  </button>
			  <button type="button" class="btn btn-default closepri" data-dismiss="modal">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body">
				<iframe frameborder="0" src="" style="width:100%;height:80vh;" id="myFrame" name="printframe"></iframe>
			</div> 
		</div>
	</div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="bookingcancelmodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Cancel Insuarance</h4>
			  <button type="button" class="btn btn-default closepri" data-dismiss="modal">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body text-center">
			 {{ Form::open(array('url' => 'admin/member/cancel-insurance', 'autocomplete'=>'off')) }}
					   
			<input type="hidden" name="ins_id" id="ins_id">
			
				<p>Are you sure you want cancel this?</p>
				<button type="submit" onclick="" class="btn btn-danger">
				<span aria-hidden="true">Cancel Insuarance</span>
			  </button>
			   {{ Form::close() }}
			</div> 
		</div>
	</div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="bookingactivemodel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Activate Insuarance</h4>
			  <button type="button" class="btn btn-default closepri" data-dismiss="modal">
				<span aria-hidden="true">Close</span>
			  </button>
			</div>

			<div class="modal-body text-center">
			 {{ Form::open(array('url' => 'admin/member/active-insurance', 'autocomplete'=>'off')) }}
					   
			<input type="hidden" name="ins_id" id="ins_id">
			
				<p>Are you sure you want activate this?</p>
				<button type="submit" onclick="" class="btn btn-success">
				<span aria-hidden="true">Activate Insuarance</span>
			  </button>
			   {{ Form::close() }}
			</div> 
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function($){
	$('.print_insurance').on('click', function(){ 
		var val = $(this).attr('dataid');
		$('#pdfmodel').modal('show'); 		 
		$("#pdfmodel .modal-body iframe").attr('src', site_url+'/admin/document/print/'+val);
	});
	$('.cancelins').on('click', function(){
		var val = $(this).attr('dataid');
		$('#ins_id').val(val);
		$('#bookingcancelmodel').modal('show');
	});
	$('.activeins').on('click', function(){
		var val = $(this).attr('dataid');
		$('#ins_id').val(val);
		$('#bookingactivemodel').modal('show');
	});
});
</script> 

@endsection
