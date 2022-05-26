@extends('layouts.admin')
@section('title', 'Create Ads')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/ads/store', 'name'=>"add-ads", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Ads Info</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>Sale Type</label>
								<select class="form-control" name="sale_type">
									<option value="rent">Rent</option>
									<option value="sale">Sale</option>
								</select>
							</div>
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" name="price" data-valid="required" class="form-control"/>
								@if ($errors->has('price'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('price') }}</strong>
									</span> 
								@endif
							</div>
							{{--<div class="form-group">
								<label>Category</label>
								<select onchange="myChildFunction()" id="category" class="form-control" name="category" data-valid="required">
								<option value="">Select category</option>
									@foreach (\App\Category::where('parent', 0)->get() as $pt_cat)
									<option value="{{ @$pt_cat->id }}">{{ @$pt_cat->title }}</option>
									@endforeach									
								</select>
								@if ($errors->has('category'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('category') }}</strong>
									</span> 
								@endif 
							</div>
							<div class="form-group">
								<label>Sub Category</label>
								<select id="sub_category" class="form-control" name="sub_category" data-valid="required">
									<option value="">Select Subcategory</option>
								</select>
								@if ($errors->has('sub_category'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('sub_category') }}</strong>
									</span> 
								@endif
							</div> --}}
							
							
							<div class="form-group">
								<label>Tags</label>
								<input type="text" name="tags" data-valid="" class="form-control"/>
								<p>(Sepreate with commas)</p>
								@if ($errors->has('tags'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('tags') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" data-valid="" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Photos</label>
								<div class="custom_photos">
									<div class="photo_col">										
										<div class="field_upload">
											<input id="imgInp" type="file" name="photos" class="form-control imgInpphoto1"/>
											<img style="display:none;" id="img_photo1" src="#" alt="your image" />
											<div id="rem_photo1" class="upload_remove"><i class="fa fa-times"></i></div>
											<div class="upload_btn"><i class="fa fa-plus i_photo1"></i>						
											</div>
										</div>
									</div> 
									{{--<div class="photo_col">
										<div class="field_upload">
											<input id="imgInps" type="file" name="photos_1" class="form-control imgInpphoto2"/>
											<img style="display:none;" id="img_photo2" src="#" alt="your image" />
											<div id="rem_photo2" class="upload_remove"><i class="fa fa-times"></i></div>
											<div class="upload_btn"><i class="fa fa-plus i_photo2"></i>
											</div>
										</div>
									</div>
									<div class="photo_col">
										<div class="field_upload">
											<input type="file" id="imgInpa" name="photos_2" class="form-control imgInpphoto3"/>
											<img style="display:none;" id="img_photo3" src="#" alt="your image" />
											<div id="rem_photo3" class="upload_remove"><i class="fa fa-times"></i></div>
											<div class="upload_btn"><i class="fa fa-plus i_photo3"></i>
											</div>
										</div>
									</div>--}}
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="str_address" data-valid="required" class="form-control"/>
								@if ($errors->has('str_address'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('str_address') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Country</label> 
								<select id="country" onchange="stateFunction()" class="form-control" name="country_id" data-valid="required">   
								<option value="">Select Country</option>
									@foreach (\App\Country::all() as $cntry)
									<option value="{{ @$cntry->id }}">{{ @$cntry->name }}</option>
									@endforeach									
								</select>
								@if ($errors->has('country_id'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('country_id') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>State</label>
								<select id="state" onchange="cityFunction()" class="form-control" name="state_id" data-valid="required">   
									<option value="">Select State</option>
								</select>  
								@if ($errors->has('state_id'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('state_id') }}</strong>
									</span> 
								@endif 
							</div> 
							<div class="form-group">
								<label>City</label>
								<select id="city" class="form-control" name="city_id" data-valid="required">   
									<option value="">Select City</option>
								</select>
								@if ($errors->has('city_id'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('city_id') }}</strong>
									</span> 
								@endif  
							</div>
							<div class="form-group">
								<label>Pin Code</label>
								<input type="text" name="pin_code" data-valid="required" class="form-control"/>
								@if ($errors->has('pin_code'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('pin_code') }}</strong>
									</span> 
								@endif
							</div>
						</div>
					</div>
						<div class="card">
						<div class="card-header"> 
							<h4>Property Information</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>No of Beds</label>
								<input type="number" name="no_of_beds" data-valid="" class="form-control"/>
								@if ($errors->has('no_of_beds'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('no_of_beds') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>No of Hall</label>
								<input type="number" name="no_of_hall" data-valid="" class="form-control"/>
								@if ($errors->has('no_of_hall'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('no_of_hall') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>No of Bathroom</label>
								<input type="number" name="no_of_bathroom" data-valid="" class="form-control"/>
								@if ($errors->has('no_of_bathroom'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('no_of_bathroom') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Space (Sq)</label>
								<input type="text" name="space" data-valid="" class="form-control"/>
								@if ($errors->has('space'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('space') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Built Year</label>
								<input type="text" name="year" data-valid="" class="form-control"/>
								@if ($errors->has('year'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('year') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>No of Floors</label>
								<input type="text" name="no_floor" data-valid="" class="form-control"/>
								@if ($errors->has('no_floor'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('no_floor') }}</strong>
									</span> 
								@endif
							</div>
							
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Contact Information</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" data-valid="" class="form-control"/>
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" data-valid="" class="form-control"/>
								@if ($errors->has('email'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('email') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="phone" data-valid="" class="form-control"/>
								@if ($errors->has('phone'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('phone') }}</strong>
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
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
							</div>
							<div class="card-footer"> 
							<button type="button" onClick="customValidate('add-ads')" class="btn btn-success pull-right">Submit</button>
						</div>
							</div>
							<div class="card">
						<div class="card-header"> 
							<h4>Amenities</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								
								<ul>
								@foreach(\App\Amenities::all() as $list)
									<li><label><input type="checkbox" name="amenities[]" value="{{$list->id}}"> {{$list->title}}</label></li>
								@endforeach
								</ul>
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
@section('scripts')
<script>
jQuery(document).ready(function($){
	function readURL(input, type) {
    if (input.files && input.files[0]) {
		
        var reader = new FileReader();

        reader.onload = function (e) {
			$('.i_'+type).hide();
			$('#img_'+type).show();
			$('#rem_'+type).show();
            $('#img_'+type).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".upload_remove").on('click', function(){
	var s = $(this).attr('id');
	var v = s.split('_');
	var type = v[1];
	$('.i_'+type).show();
	$('#img_'+type).hide();
	$('#rem_'+type).hide();
	$('#img_'+type).attr('src','');
	$('.imgInp'+type).val('');
	
});

$(document).delegate("#imgInp", 'change',function(){
    readURL(this, 'photo1');
});

	$(document).delegate("#imgInps", 'change',function(){
    readURL(this, 'photo2');
});
	$(document).delegate("#imgInpa", 'change',function(){

    readURL(this, 'photo3');
});
});
</script>
@endsection