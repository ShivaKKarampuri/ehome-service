<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lottery | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/png" href="{!! asset('public/img/fav.png') !!}"/>
  
  <!-- General CSS Files -->
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/app.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/bundles/summernote/summernote-bs4.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/custom.css')}}">
  
</head>      
<body>
	<div class="loader"></div>  
	<div id="app">    
		<div class="main-wrapper main-wrapper-1">
		
			@include('../Elements/Admin/header')
			<!-- Header Navbar: style can be found in header.less -->
		
			<!-- Left side column. contains the logo and sidebar -->
			 @include('../Elements/Admin/left-side-bar')
			<!-- /.content-wrapper -->
			  @yield('content')
			<!-- /.content-wrapper -->

			<!--Footer-->
			@include('../Elements/Admin/footer')

		</div>
	</div> 

<!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
		</script>
<!-- General JS Scripts -->
  <script src="{{URL::asset('public/backend/assets/js/app.min.js')}}"></script>
  <script src="{{URL::asset('public/backend/assets/bundles/summernote/summernote-bs4.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{URL::asset('public/backend/assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <!-- Page Specific JS File -->  
  <script src="{{URL::asset('public/backend/assets/js/page/index.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{URL::asset('public/backend/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{URL::asset('public/backend/assets/js/custom.js')}}"></script>
   <!-- Custom form Validation File -->
  <script src="{{URL::asset('public/js/custom-form-validation.js')}}"></script>
  <script src="{{URL::asset('public/js/custom.js')}}"></script>
  <script>
	function myChildFunction() {
		  var  categoryid= document.getElementById("category").value;
		  $('#sub_category').prop('disabled',true);
		 $('#sub_category').html('');
		  $.ajax({
            type: "GET",
            url: "{{URL::to('/admin/getsubcategory')}}",
            data: {categoryid:categoryid},
            //dataType: "JSON",
            success: function(response) {
				var asd = response;
				
				//document.getElementById("item_select").innerHTML = asd;
				$('#sub_category').append('<option value="">Select Subcategory</option>');
				$('#sub_category').append(asd);
				//alert(asd); 
             $('#sub_category').prop('disabled',false);
			 	
            },
            error: function (jqXHR, textStatus, errorThrown) {
				$('#sub_category').prop('disabled',false);
          alert(textStatus + " in pushJsonData: " + errorThrown + " " + jqXHR);
        }
        });
		}
		
		function stateFunction() {
		  var  countryid= document.getElementById("country").value;
		  $('#state').prop('disabled',true);
		 $('#state').html('');
		  $.ajax({
            type: "GET",
            url: "{{URL::to('/admin/getstate')}}",
            data: {countryid:countryid},
            //dataType: "JSON",
            success: function(response) {
				var asd = response;
				
				//document.getElementById("item_select").innerHTML = asd;
				$('#state').append('<option value="">Select State</option>');
				$('#state').append(asd);
				//alert(asd); 
             $('#state').prop('disabled',false);
			 	
            },
            error: function (jqXHR, textStatus, errorThrown) {
				$('#state').prop('disabled',false);
          alert(textStatus + " in pushJsonData: " + errorThrown + " " + jqXHR);
        }
        });
		} 
		
		function cityFunction() {  
		  var  stateid= document.getElementById("state").value;
		  $('#city').prop('disabled',true);
		 $('#city').html('');
		  $.ajax({
            type: "GET",
            url: "{{URL::to('/admin/getcity')}}",
            data: {stateid:stateid},
            //dataType: "JSON",
            success: function(response) {
				var asd = response;
				
				//document.getElementById("item_select").innerHTML = asd;
				$('#city').append('<option value="">Select City</option>');
				$('#city').append(asd);
				//alert(asd); 
             $('#city').prop('disabled',false);
			 	
            },
            error: function (jqXHR, textStatus, errorThrown) {
				$('#city').prop('disabled',false);
          alert(textStatus + " in pushJsonData: " + errorThrown + " " + jqXHR);
        }
        });
		} 
		
  </script>
@yield('scripts')
</body>
</html>