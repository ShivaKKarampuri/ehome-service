@extends('layouts.admin')
@section('title', 'Export')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Export Report</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Export Report</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->	
	
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
						<div class="card-body">
							<ul class="nav nav-tabs nav_custom_tabs" id="custom-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="daily_report-tab" data-toggle="pill" href="#daily_report" role="tab" aria-controls="daily_report" aria-selected="true">Export Report</a>
								</li>
								
							</ul>
							<div class="tab-content" id="custom-tab-content"> 
								<div class="tab-pane active show" id="daily_report" role="tabpanel" aria-labelledby="daily_report-tab">
									<div class="daily_sale_report common_report"> 
										<h4>Refine Your Results</h4><form action="{{route('admin.export.report')}}" autocomplete="off" method="get">
										<div class="cus_report_field">	
											<div class="row">	
											
												<div class="col-sm-4">
													<div class="form-group">
														<label>Date From</label>
														<input autocomplete="off" type="text" class="form-control commondate" name="from" value="{{Request::get('from')}}"/>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label>Date To</label>
														<input autocomplete="off" type="text" class="form-control commondate" name="to" value="{{Request::get('to')}}"/>
													</div>
												</div>
												
												<div class="col-sm-12">
													<div class="generate_dsr_btn text-right">
														<button type="submit" class="cus_btn">Search </button>
													</div>
												</div>
												
											</div>
										</div>
										</form>
										
									</div>
								</div>
								
							</div>
						</div>	
					</div>	
				</div>	
			</div>
		</div>
	</section>
</div>
<script>

</script>
@endsection