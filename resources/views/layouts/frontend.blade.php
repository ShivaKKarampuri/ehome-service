<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Best tour planner is leading travel agency in delhi offer best holiday packages services">
    <meta name="author" content="Ansonika">
    <title>BTP- Customize & Book Amazing Holiday Packages </title>
	<!--<title>@yield('title')</title>-->
	<!-- Favicons-->
    <link rel="shortcut icon" href="{!! asset('public/img/Frontend/img/favicon.png') !!}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{!! asset('public/img/Frontend/img/apple-touch-icon-57x57-precomposed.png') !!}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{!! asset('public/img/Frontend/img/apple-touch-icon-72x72-precomposed.png') !!}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{!! asset('public/img/Frontend/img/apple-touch-icon-114x114-precomposed.png') !!}">

 <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="{{URL::asset('public/css/Frontend/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/css/Frontend/style.css')}}" rel="stylesheet">
	<link href="{{URL::asset('public/css/Frontend/vendors.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
	<!-- ALTERNATIVE COLORS CSS -->
    <link href="#" id="colors" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="{{URL::asset('public/css/Frontend/custom.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/css/Frontend/modernizr_slider.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="{{URL::asset('public/js/Frontend/jquery-2.2.4.min.js')}}"></script>
	<style>
	.ui-autocomplete-category {
    font-weight: bold;
    padding: .2em .4em;
    margin: .8em 0 .2em;
    line-height: 1.5;
  }
  
	</style>
	<!--<script src="{{URL::asset('public/js/Frontend/jquery-min.js')}}"></script>	-->
	</head>
	<body>
		<div id="page">		
			<!--Header-->
				@include('../Elements/Frontend/header')
			<main>
			<!--Content-->
				@yield('content') 
			</main>
			<!-- /main -->
			<!--Footer-->
				@include('../Elements/Frontend/footer')
		</div>
		 <!-- page -->	
		<!-- Sign In Popup -->
		<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
			<div class="small-dialog-header">
				<h3>Sign In</h3>
			</div>
			<form>
				<div class="sign-in-wrapper">
					<a href="#0" class="social_bt facebook">Login with Facebook</a>
					<a href="#0" class="social_bt google">Login with Google</a>
					<div class="divider"><span>Or</span></div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" id="email">
						<i class="icon_mail_alt"></i>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" id="password" value="">
						<i class="icon_lock_alt"></i>
					</div>
					<div class="clearfix add_bottom_15">
						<div class="checkboxes float-left">
							<label class="container_check">
								Remember me
								<input type="checkbox">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
					</div>
					<div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
					<div class="text-center">
						Don’t have an account? <a href="../index.html">Sign up</a>
					</div>
					<div id="forgot_pw">
						<div class="form-group">
							<label>Please confirm login email below</label>
							<input type="email" class="form-control" name="email_forgot" id="email_forgot">
							<i class="icon_mail_alt"></i>
						</div>
						<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
						<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
					</div>
				</div>
			</form>
			<!--form -->
		</div>
		<!-- /Sign In Popup -->
		<div id="toTop"></div><!-- Back to top button -->
		
		<!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
			var redirecturl = "<?php echo URL::to('/thanks'); ?>";
		</script>
		 
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
		<script src="{{URL::asset('public/js/Frontend/bootstrap.min.js')}}"></script> -->
		<script src="{{URL::asset('public/js/Frontend/common_scripts.js')}}"></script>
		<script src="{{URL::asset('public/js/Frontend/main.js')}}"></script>
		<script src="{{URL::asset('public/js/Frontend/validate.js')}}"></script>
		<script src="{{URL::asset('public/js/Frontend/readmore_fade.js')}}"></script>
		<script src="{{URL::asset('public/js/Frontend/custom.js')}}"></script>
		<script src="{{URL::asset('public/js/custom-form-validation.js')}}"></script>
		<!-- FlexSlider -->
		<script defer src="{{URL::asset('public/js/Frontend/jquery.flexslider.js')}}"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		
		<script>
		function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
	
	if(filter == ""){
		console.log("dddd");
			 $('#loadMore').show();
			  x = 3;
			  $('#myUL li').hide();
			  $('#myUL li:lt(' + x + ')').show();
		}else{
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("label")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
			console.log("qqqqq");
            li[i].style.display = "list-item";
			 $('#loadMore').hide();
        } 
		else {
			console.log("aaaa");
			 $('#loadMore').hide();
            li[i].style.display = "";
        }
    }
		}
}
			<!-- Range Slider --> 
			$("#budgetrange").ionRangeSlider({
				hide_min_max: true,
				keyboard: true,
				min: miprice,
				max: maxprice,
				from: miprice,
				to: maxprice,
				type: 'double',
				step: 1,
				prefix: "INR. ",
				grid: false,
				onFinish: function (data) {
					$('#mloader').show();
					$('.common_price').remove();
					$('.clear_filter').show();
					$('.applied_filter ul').append('<li id="remove_'+data.from+'_'+data.to+'" class="common_price">'+'INR '+data.from+' - INR '+data.to+'<a cityid="price_'+data.from+'" id="'+data.from+'_'+data.to+'" class="closefilter"> <i class="fa fa-close"></i></a><input type="hidden" id="mprice" value="'+data.from+'_'+data.to+'"></li>');
					
					var favorite = [];
					$.each($(".mmtheme"), function(){
						favorite.push($(this).val());
					});
					$.ajax({
						type: 'get',
						url: '{{route('searchpackage')}}', 
						data: {
							ptype: favorite, 
							price: data.from+'_'+data.to, 
							duration: $('#mduration').val(),  
							city: $('#mcity').val(),  
							slug: $('#mslug').val(),
							tslug: $('#tslug').val(),
						  /* here goes Data from S2 */
						},
						success: function(res){
							$('#mloader').hide();
							$('#ajaxResultContainer').html(res);
						}
					});
				}
			}); 
			$("#durationrange").ionRangeSlider({
				hide_min_max: true,
				keyboard: true,
				min: min_nigt,
				max: max_day,
				from: min_nigt,
				to: max_day,
				type: 'double',
				step: 1,
				prefix: "N ",
				grid: false,
				onFinish: function (data) {
					$('#mloader').show();
					$('.common_duration').remove();
					$('.clear_filter').show();
					$('.applied_filter ul').append('<li id="remove_'+data.from+'_'+data.to+'" class="common_duration">'+data.from+' Nights - '+data.to+' Nights <a id="'+data.from+'_'+data.to+'" cityid="duration_'+data.from+'" class="closefilter"> <i class="fa fa-close"></i></a><input type="hidden" id="mduration" value="'+data.from+'_'+data.to+'"></li>');
					var favorite = [];
					$.each($(".mmtheme"), function(){
						favorite.push($(this).val());
					});
					$.ajax({
						type: 'get',
						url: '{{route('searchpackage')}}', 
						data: {
							ptype: favorite, 
							duration: data.from+'_'+data.to,  
							price: $('#mprice').val(),  
							city: $('#mcity').val(),  
							slug: $('#mslug').val(),
							tslug: $('#tslug').val(),
						  /* here goes Data from S2 */
						},
						success: function(res){
							$('#mloader').hide();
							$('#ajaxResultContainer').html(res);
						}
					});
				}
			});  

		</script>
		<script>
$( function() {
	 
  size_li = $("#myUL li").length;
  x = 3;
  $('#myUL li:lt(' + x + ')').show();
  $('#loadMore').click(function() {
    x = (x + 5 <= size_li) ? x + 5 : size_li;
    $('#myUL li:lt(' + x + ')').show();
	 if(x == size_li){
            $('#loadMore').hide();
        }
  });
 

	$(document).delegate('.clear_filter','click', function(){
		$('.applied_filter ul').html('');
		$('#mloader').show(); 
		$('.clear_filter').hide();
			$('#dcity').val('');
		
			$("input[name='themes']").prop('checked',false).iCheck('update');
		
			var $slider = $("#budgetrange"); // replace js-range with your class name
var slider_instance = $slider.data("ionRangeSlider");
slider_instance.reset();
		
			var $slider = $("#durationrange"); // replace js-range with your class name
var slider_instance = $slider.data("ionRangeSlider");
slider_instance.reset();
		
		$.ajax({
				type: 'get',
				url: '{{route('searchpackage')}}', 
				data: {
					ptype: '', 
					price: '', 
					duration: '',  					
					city: '', 
					slug: $('#mslug').val(),
					tslug: $('#tslug').val(),
				  /* here goes Data from S2 */
				},
				success: function(res){
					$('#mloader').hide();
					$('#ajaxResultContainer').html(res);
				}
			});
	});
	$(document).delegate('.closefilter','click', function(){
		var fav = $(this).attr('id');
		var cityid = $(this).attr('cityid');
		$('#remove_'+fav).remove();
		$('#mloader').show(); 
		var splitid =  cityid.split('_');
		if(splitid[0] == 'city'){
			$('#dcity').val('');
		}else if(splitid[0] == 'theme'){
			$("input[value='"+splitid[1]+"']").prop('checked',false).iCheck('update');
		}else if(splitid[0] == 'price'){
			var $slider = $("#budgetrange"); // replace js-range with your class name
var slider_instance = $slider.data("ionRangeSlider");
slider_instance.reset();
		}else if(splitid[0] == 'duration'){
			var $slider = $("#durationrange"); // replace js-range with your class name
var slider_instance = $slider.data("ionRangeSlider");
slider_instance.reset();
		}
		var favorite = [];
		$.each($(".mmtheme"), function(){
						favorite.push($(this).val());
					});
			if( !$('.applied_filter ul').has('li').length ) {
				$('.clear_filter').hide();
			}
			$.ajax({
				type: 'get',
				url: '{{route('searchpackage')}}', 
				data: {
					ptype: favorite, 
					price: $('#mprice').val(), 
					duration: $('#mduration').val(),  					
					city: $('#mcity').val(), 
					slug: $('#mslug').val(),
					tslug: $('#tslug').val()
				  /* here goes Data from S2 */
				},
				success: function(res){
					$('#mloader').hide();
					$('#ajaxResultContainer').html(res);
				}
			});
	})
	$('.myListicheck').on('ifChanged', function(){
		var favorite = [];
		$('#mtheme').html('');
		$('.common_theme').remove();
		$('.clear_filter').show();
            $.each($("input[name='themes']:checked"), function(){
                favorite.push($(this).val());
				
				$('.applied_filter ul').append('<li id="remove_'+$(this).val()+'" class="common_theme">'+$(this).attr('dataname')+'<a id="'+$(this).val()+'" cityid="theme_'+$(this).val()+'" class="closefilter"> <i class="fa fa-close"></i></a><input type="hidden" class="mmtheme" value="'+$(this).val()+'"></li>');
            }); 
			  $('#mloader').show(); 
			$.ajax({
				type: 'get',
				url: '{{route('searchpackage')}}', 
				data: {
					ptype: favorite, 
					price: $('#mprice').val(), 
					duration: $('#mduration').val(),  					
					city: $('#mcity').val(), 
					slug: $('#mslug').val(),
					tslug: $('#tslug').val(),
				  /* here goes Data from S2 */
				},
				success: function(res){
					$('#mloader').hide();
					$('#ajaxResultContainer').html(res);
				}
			});
	});
	$('#dcity').on('change', function(){
		 $('#mloader').show(); 
		var va = $('#dcity option:selected').val();
		var vad = $('#dcity option:selected').text();
		$('.common_city').remove();
		$('.clear_filter').show();
		$('.applied_filter ul').append('<li id="remove_'+va+'"  class="common_city">'+vad+'<a id="'+va+'" class="closefilter" cityid="city_'+va+'"> <i class="fa fa-close"></i></a><input type="hidden" id="mcity" value="'+va+'"></li>');
		var favorite = [];
		$.each($(".mmtheme"), function(){
						favorite.push($(this).val());
					});
			$.ajax({
				type: 'get',
				url: '{{route('searchpackage')}}', 
				data: {
					ptype: favorite,
					city: va, 
					price: $('#mprice').val(), 
					duration: $('#mduration').val(),  	
					slug: $('#mslug').val(),
					tslug: $('#tslug').val(),
				  /* here goes Data from S2 */
				},
				success: function(res){
					 $('#mloader').hide(); 
					
					$('#ajaxResultContainer').html(res);
				}
			});
		
	});
	
	$('.gallerypopup').on('click', function(){
		var src = $(this).attr('ng-src');
		$('.zoomsow').attr('src',src);
		$('#myModalZoom').modal('show');
		
	});
	$('article').readmore();
    $.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;
          if ( item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category ) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
        });
      }
    }); 
   
 
    $( ".search-query" ).catcomplete({
      delay: 0,
      source: '{{route('Searchtour')}}'
	   ,search: function (e, u) {
			 $('.myloader').css('display','block');
		},response: function (e, u) {
                $('.myloader').css('display','none');
            }
    });
  } );
			$(window).load(function () {
				'use strict';
				$('#carousel_slider').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 280,
					itemMargin: 25,
					asNavFor: '#slider'
				});
				$('#slider').flexslider({
					animation: "fade",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					sync: "#carousel_slider",
					start: function (slider) {
						$('body').removeClass('loading');
					}
				});
			});
			
			(function( $ ){  
				$( document ).ready( function() {
					$( '.input-range').each(function(){
						var value = $(this).attr('data-slider-value');
						var separator = value.indexOf(',');
						if( separator !== -1 ){
							value = value.split(',');
							value.forEach(function(item, i, arr) {
								arr[ i ] = parseFloat( item );
							});
						} else {
							value = parseFloat( value );
						}
						$( this ).slider({
							formatter: function(value) {
								console.log(value);
								return '$' + value;
							},
							min: parseFloat( $( this ).attr('data-slider-min') ),
							max: parseFloat( $( this ).attr('data-slider-max') ), 
							range: $( this ).attr('data-slider-range'),
							value: value,
							tooltip_split: $( this ).attr('data-slider-tooltip_split'),
							tooltip: $( this ).attr('data-slider-tooltip')
						});
					});
					
				 } );
				} )( jQuery );
		</script>
		<script>
		$(document).ready(function() {
 
  /* $("#recommended_india_tour").owlCarousel({ 
	  items : 4,
	  loop:true,
	  autoWidth:true,
	  itemsDesktop : [1199,4],
    itemsDesktopSmall : [980,4], 
    itemsTablet: [768,2],
    itemsTabletSmall: false,
    itemsMobile : [479,1],
    singleItem : false,
	autoPlay : false,
	navigation : true,
    navigationText : ["prev","next"],
  }); */
  
  $("#recommended_india_tour").owlCarousel({ 
	  loop:true,
    margin:10,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
  }); 
   $("#recommended_international_tour").owlCarousel({ 
	  loop:true,
    margin:10,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
  }); 
 
});
			$('.owl-carousel').find('.owl-nav').removeClass('disabled');
			$('.owl-carousel').on('changed.owl.carousel', function(event) {
				$(this).find('.owl-nav').removeClass('disabled');
			});
 			$('input[name="traveldate"]').daterangepicker({
				singleDatePicker: true,
				
			  locale: {
				  cancelLabel: 'Clear'
			  }
		  });
		  $('input[name="traveldates"]').daterangepicker({
				singleDatePicker: true,
				
			  locale: {
				  cancelLabel: 'Clear'
			  }
		  });
		/* $('input[name="traveldate"]').daterangepicker({
			"singleDatePicker": true,
			"autoApply": true,
			parentEl:'#input_date',
			"linkedCalendars": false,
			"showCustomRangeLabel": false
		}, function(start, end, label) {
		  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		}); */
		</script>
		<script> 
$(document).ready(function(){
	$(document).on("submit", "#searchform", function(e){
    e.preventDefault();
    var val = $('.search-query').val();
		if(val != ''){
		window.location = '{{URL::to('/destinations/')}}/'+ val;
		}
    return  false;
});

	$(".myqueryli").on("click", function(){
		var dataid = $(this).attr("datapacid");
		
		$("#mpackage_id").val(dataid);
		$('input[name="traveldate"]').daterangepicker({
				singleDatePicker: true,
				
			  locale: {
				  cancelLabel: 'Clear'
			  }
		  });
	});
	$(".hotelcontent").on("click", function(){
		var dataid = $(this).attr("datid");
		
		$("#hotelcontent h4").html(gallerydata[dataid]['hotelname']);
		$("#hotelcontent .hotel_description").html(gallerydata[dataid]['description']);
		var datatml = '';
		for(var ik =0; ik < gallerydata[dataid]['star']; ik++){
			 datatml += ('<img src="{!! asset('public/img/star.png') !!}" alt="Star Rating" title="Star Rating">');
		}
		$("#hotelcontent .starmargin").html(datatml);
		$("#hotelcontent .loclity").html('<span class="textblack13bold ng-scope">Locality: '+gallerydata[dataid]['address']+'</span>');
		$("#hotelcontent").modal("show");
	});
});
</script>
		<!-- Modal -->
		<div class="modal fade" id="inquirymodal" tabindex="-1" role="dialog" aria-labelledby="inquirymodalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="inquirymodalLabel">Quick Inquiry</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="pkgform-wrapper">
						<div class="cont-wth1">
							<div class="pkgform-headbx text-center">QUICK CONTACT <span class="title-arrow"></span></div>
							<div class="pkgform-box">
							
								{{ Form::open(array('url' => 'enquiry-contact', 'name'=>"queryform", 'autocomplete'=>'off','id'=>'popenquiryco')) }}
								<span class="customerror"></span>
									<input type="text" data-valid = 'required' name="name" class="form-control" value="" placeholder="Name">                                
									<input type="text" data-valid = 'required' name="email" class="form-control" value="" placeholder="Email">
									<input type="text" data-valid = 'required' name="phone" class="form-control" value="" placeholder="Phone"> 
									<input type="text" data-valid = 'required' name="city" class="form-control" value="" placeholder="City">
									<div class="form-group">
										<input type="text" id="" data-valid = 'required' name="traveldate" class="form-control" value="" placeholder="Travel Date">	
									</div>
									<div class="row"> 
										<div class="col-sm-6 col-xs-6 codwh">
											<select class="form-control" name="adults">
												<option value="">Adults*</option>
												<?php
												for($ai=1;$ai<=10;$ai++){
													?>
													<option value="{{$ai}}">{{$ai}}</option>
													<?php
												}
												?>
											</select>
										</div>                                    
										<div class="col-sm-6 col-xs-6 leftpd"> 
											<select class="form-control" name="children">
												<option value="">Children (5-12 yr)</option>
												<?php
												for($ck=1;$ck<=10;$ck++){
													?>
													<option value="{{$ck}}">{{$ck}}</option>
													<?php
												}
												?>
											</select>
									   </div>
									</div>                                
									<textarea class="form-control" type="text" name="add_info" placeholder="Want to customize this package? Tell us more"></textarea>
									<div class="row">
										<div class="col-sm-7 col-xs-8 codwh">
										<?php $codes=rand(1000,9999); ?>
											<input data-valid = 'required captcha' class="form-control" type="text" name="captcha" value="" placeholder="Enter Code" maxlength="4">
										</div>
										<div class="col-sm-5 col-xs-4 codwh-1">
											<input type="hidden" name="code" value="{{$codes}}">
											<img src="{{route('sicaptcha')}}?code={{$codes}}" class="img-responsive" alt="Captcha" width="65" height="25">
										</div>
									</div>
										<input type="hidden" id="mpackage_id" name="package_id" value="">									
									{{ Form::button('Submit', ['class'=>'submitbtt', 'onClick'=>'customValidate("queryform")' ]) }}
								{{ Form::close() }}
							</div>  
						</div>
					</div>
				</div>  
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		  </div>
		</div> 
		<div id="myModalZoom" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<img src="" class="img-fluid zoomsow" alt="" width="100%" height="533">
					</div>     
				</div>
			</div>
		</div>
		<div id="hotelcontent" class="modal fade" role="dialog">
			<div class="modal-dialog"> 
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4></h4>
						<div class="starmargin ">
						</div>
						<div class="loclity ">
							<span class="textblack13bold ng-scope">Locality:</span>
						</div>
						<div class="hotel_description">This Hotels is very comfortable and 5 star hotels. These room services is awesome.</div>
					</div>     
				</div>
			</div>
		</div>	
	</body>
</html>