<!DOCTYPE html>
<html lang="en">
	<head>
		
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Lottery Login</title>
	<link rel="shortcut icon" type="image/png" href="{!! asset('public/img/fav.png') !!}"/>
	<!-- Favicons-->
		
	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/app.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/bundles/bootstrap-social/bootstrap-social.css')}}">
	<!-- Template CSS -->
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/style.css')}}">
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/components.css')}}">
	<!-- Custom style CSS -->
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/custom.css')}}">
	<style>
		.login_card .card-header{flex-direction: column;} 
		.login_card .card-header h4{display:block;} 
		.login_card .card-header p.login_msg{font-size:14px;line-height:18px;}
	</style>
	</head>
	<body>
				
		@yield('content')
		
		<!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
		</script>
		
<!-- General JS Scripts -->
<script src="{{URL::asset('public/backend/assets/js/app.min.js')}}"></script>
<!-- JS Libraies -->
  <!-- Page Specific JS File -->
<!-- Template JS File -->
  <script src="{{URL::asset('public/backend/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{URL::asset('public/backend/assets/js/custom.js')}}"></script>
<script>
  /* $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  }); */
</script>
	</body>
</html>