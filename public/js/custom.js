/********************************Jquery Functions Start****************************************/
//String Limit Start
	function strLimit(string){
		var length = string.length;
		if(length > 50){
			var string = string.substr(0, 49);
			var string = string+'...';
		}
		return string;
	}

//String Limit End

//Delete Function Start
	function deleteAction( id, table ) {
		var conf = confirm('Are you sure, you would like to delete this record. Remember all Related data would be deleted.');
		if(conf){	
			if(id == '') {
				alert('Please select ID to delete the record.');
				return false;	
			} else {
				$(".server-error").html(''); //remove server error.
				$(".custom-error-msg").html(''); //remove custom error.
				$.ajax({
					type:'post',
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url:site_url+'/admin/delete_action',
					data:{'id': id, 'table' : table},
					success:function(resp) {
						var obj = $.parseJSON(resp);
						if(obj.status == 1) {
							$("#id_"+id).remove();
							//show success msg 
								var html = successMessage(obj.message);
								$(".custom-error-msg").html(html);
							
							//show count
								var old_count = $(".count").text();
								var new_count = old_count - 1;
								$(".count").text(new_count);
							
							//when all data has been deleted
								if(new_count == 0){
									$(".tdata").html('<tr><td colspan="6">There are no data in this table.</td></tr>');
								}
							
						} else{
							var html = errorMessage(obj.message);
							$(".custom-error-msg").html(html);
						}
						$(".loader").hide();
					},
					beforeSend: function() {
						$(".loader").show();
					}
				});
				$('html, body').animate({scrollTop:0}, 'slow');
			}
		} else{
			$(".loader").hide();
		}
	}
//Delete Function End
		
//Update Status Start
	function updateStatus( id, current_status, table ) {
		$(".server-error").html(''); //remove server error.	
		$(".custom-error-msg").html(''); //remove custom error.
		$.ajax({
			type:'post',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:site_url+'/admin/update_action',
			data:{'id': id, 'current_status' : current_status, 'table': table},
			success:function(resp) {
				var obj = $.parseJSON(resp);
				if(obj.status == 1) {
					//show success msg 
						var html = successMessage(obj.message);
						$(".custom-error-msg").html(html);
					
					//change status
						if(current_status == 1){
							var updated_status = 0;
						} else {
							var updated_status = 1;
						}
					
						$(".change-status[data-id="+id+"]").attr('data-status', updated_status);
					
				} else{
					var html = errorMessage(obj.message);
					$(".custom-error-msg").html(html);
					
					//not change status
						if(current_status == 1){
							$(".change-status[data-id="+id+"]").prop('checked', true);
						} else {
							$(".change-status[data-id="+id+"]").prop('checked', false);
						}
				}
				$(".loader").hide();
			},
			beforeSend: function() {
				$(".loader").show();
			}
		});
		$('html, body').animate({scrollTop:0}, 'slow');
	}
//Update Status End
	
//General Function Start
	function successMessage(msg){
		var html = '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body">';
		html +=	'<button class="close" data-dismiss="alert"><span>&times;</span></button>';
		html += '<strong>'+msg+'</strong>';
		html += '</div></div>';
		
		return html;
	} 
	function errorMessage(msg){
		var html = '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body">';
		html += '<button class="close" data-dismiss="alert"><span>&times;</span></button>'+msg;	
		html += '</div></div>';
		
		return html;	
	}	
//General Function End
	
/**********************************Jquery Functions End*********************************************/

$(document).ready(function(){
	//Change Status Start
		$(document).on('click', '.change-status', function(){
			var id = $.trim($(this).attr('data-id'));
			var current_status = $.trim($(this).attr('data-status'));
			var table = $.trim($(this).attr('data-table'));
			
			if(id != "" && current_status != "" && table != ""){
				updateStatus(id, current_status, table);
			}
		});
	//Change Status End
	
	//Get Subject Details Start
		/* $('.multiselect_subject').fastselect({
			placeholder: 'Choose One...',
			onItemSelect: function($item, itemModel) {
				getSubjectDetail(itemModel.value);
			}	
		}); */
		
		var subjectId = $("#getSubjectDetailSingle").val();
		var selectedVendor = $("#storeVendorId").val();
	
		if(typeof subjectId != 'undefined'){
			if(typeof selectedVendor != 'undefined'){	
				getSubjectDetailSingle(subjectId, selectedVendor);
			} else{
				getSubjectDetailSingle(subjectId, '');
			}
		}
		
		$(document).on('change', '#getSubjectDetailSingle', function(){
			var value = $(this).val();
			getSubjectDetailSingle(value, '');
		});
		
		
		$(document).on('click', '.fstChoiceRemove', function(){
			var subjectId = $(this).parent().attr('data-value');
			var count = $(".getSubjectDetails").attr('data-count');
			if(count == 1){
				var html = '';
				html += '<div class="form-group">';
				html += '<label>No Subject selected, so please select one.</label>';
				html += '</div>';
				$(".getSubjectDetails").html('');	
				$(".getSubjectDetails").html(html);
				$(".getSubjectDetails").attr('data-count', 0);	
			} else {
				var new_count = parseInt(count) - 1;
				$(".getSubjectDetails").attr('data-count', new_count);	
			}	
			
			$("#subject-"+subjectId).remove();	
		});	
	//Get Subject Details End
	
	//Get Country State Start
		var getCountryId = $("#getCountryStates").val();
		var getSelectedStateId = $("#storeStateId").val();
		if(typeof getCountryId !== 'undefined'){
			if(typeof getCountryId !== 'undefined'){
				getCountryStates(getCountryId, getSelectedStateId);
			} else{
				getCountryStates(getCountryId, '');
			}	
		}	
		$(document).on('change', '#getCountryStates', function(){
			getCountryStates($(this).val());	
		});
	//Get Country State End
	
	//Get MCQ Chapters Start
		var getMcqSubjectId = $("#mcqSubject").val();
		var getSelectedMcqChapterId = $("#storeMcqChapterId").val();
		if(typeof getMcqSubjectId !== 'undefined'){
			if(typeof getSelectedMcqChapterId !== 'undefined'){
				getMcQChapter(getMcqSubjectId, getSelectedMcqChapterId);
			} else{
				getMcQChapter(getMcqSubjectId, '');
			}	
		}	
		$(document).on('change', '#mcqSubject', function(){
			getMcQChapter($(this).val());	
		});
	//Get MCQ Chapters End
	
	//Get Organisations Start
		//Get Password Error exist or not start
			var passwordError = $.trim($("#passwordError").text());
			if(passwordError != ''){
				$(".professorPassword").show();
				$("#orgPassword").attr( "data-valid", "required" );
			} else {
				$(".professorPassword").hide();
				
				//$("#orgPassword").val('');
				$("#orgPassword").removeAttr( "data-valid");
			}	
		//Get Password Error exist or not end
		
		var storeOldOrganisationRole  = $("#storeOldOrganisationRole").val();
		if(storeOldOrganisationRole == 4){
			$(".professorPassword").show();
			$(".extra-info").show();
		} else {
			$(".professorPassword").hide();
			$(".extra-info").hide();
		}
				
		
		$(document).on('change', '#getOrgEmail', function(){
			var value = $(this).val();
			if(value != ''){
				if(value == 0){
					$("#orgEmail").val('');
					$("#orgEmail").prop( "disabled", false );	

					$(".professorPassword").show();
					$(".extra-info").show();
					
					$("form[name='edit-professor'] :input[name='country']").val('');
					$("form[name='edit-professor'] :input[name='state']").html('<option value="">Choose One...</option>');
					$("form[name='edit-professor'] :input[name='city']").val('');
					$("form[name='edit-professor'] :input[name='address']").val('');
					$("form[name='edit-professor'] :input[name='zip']").val('');
					
					$("#orgPassword").val('');
					$("#orgPassword").attr( "data-valid", "required" );
					
				} else {
					var email = $('option:selected', this).attr('data-email');

					$("#orgEmail").val(email);
					$("#orgEmail").prop( "disabled", true );

					$(".professorPassword").hide();
					$(".extra-info").hide();
				
					$("#orgPassword").val('');
					$("#orgPassword").removeAttr( "data-valid");
				}		
			} else {
				$("#orgEmail").val('');
				$("#orgEmail").prop( "disabled", false );
				
				$(".professorPassword").hide();
				$(".extra-info").hide();
				
				$("#orgPassword").val('');
				$("#orgPassword").removeAttr( "data-valid");
			}
		});
	//Get Organisations End
	
	// Add More Function for Product Page
		$(document).on('click', '#addMore', function(){
			var itm = $(".other-product-info").first();
			var lst = $(".other-product-info").last();
			var cln = itm.clone(true);
			$(cln).insertAfter(lst);
			
			var currentCount = $("#count").val();
			var new_count = parseInt(currentCount) + 1;
			$("#count").val(new_count);
	
			$(cln).find("input:text").val("");
			$(cln).find("select").val("");	
			$(cln).find(".custom-error").text("");
			$(cln).find(".remove").show();	
	
			$(cln).find("select[name='mode_product1']").attr('name', 'mode_product'+new_count);
			$(cln).find("input[name='duration1']").attr('name', 'duration'+new_count);
			$(cln).find("input[name='validity1']").attr('name', 'validity'+new_count);
			$(cln).find("input[name='price1']").attr('name', 'price'+new_count);
			$(cln).find("input[name='discount1']").attr('name', 'discount'+new_count);
			$(cln).find("input[name='views1']").attr('name', 'views'+new_count);
	
	
			var scrollTopValue = currentCount * 580;
			$('html, body').animate({scrollTop:scrollTopValue}, 'slow');
		});
		
		$(document).on('click', '.remove', function(){			
			$(this).parent().parent().remove();	
		});
	// Add More Function for Product Page	
		
	//Add More Function for Demo Video Start	
		$(document).on('click', '#addDemoMore', function(){
			var itm = $(".demo_video_div").first();
			var lst = $(".demo_video_div").last();
			var cln = itm.clone(true);
			$(cln).insertAfter(lst);
			
			var currentCountDemo = $("#countDemo").val();
			var new_count = parseInt(currentCountDemo) + 1;
			$("#countDemo").val(new_count);
			
			$(cln).find("input:text").val("");
			$(cln).find(".removeDemoMore").show();

			$(cln).find("input[name='demo_videos1']").attr('name', 'demo_videos'+new_count);
		});
		
		$(document).on('click', '.removeDemoMore', function(){			
			$(this).parent().parent().remove();	
		});
	//Add More Function for Demo Video End
	
	// Free Downloads Start
		var free_type_value = $.trim($("#free_type").val());
		if(free_type_value != ''){
			var label =	$("#free_type option:selected").text();
			var label_content = "";
			label_content += label+"<em>*</em>";
			
			$("#content_label").html("");	
			$("#content_label").html(label_content);

			var content_field = "";
			var content = $("#old_content").val();
			
			if(free_type_value == 1){ //audio
				content_field += "<input type='file' name='content' class='form-control uploadAudioFile' /><div class='audio'><audio controls=''><source src='"+site_url+"/public/img/free_downloads/audio/"+content+"' height='50' width='50' type='audio/mp3'></audio></div>";	
			} else if(free_type_value == 2){ //video
				content_field += "<input type='file' name='content' class='form-control uploadVideoFile' /><div class='video'><video width='320' height='240' controls><source src='"+site_url+"/public/img/free_downloads/video/"+content+"' type='video/mp4'>Your browser does not support the video tag.</video></div>";	
			} else if(free_type_value == 3){ //pdf
				content_field += "<input type='file' name='content' class='form-control uploadFile' /><div class='pdf'><a href='"+site_url+"/public/img/free_downloads/pdf/"+content+"' target='_blank'><img src='"+site_url+"/public/img/pdf.jpg' class='pdf-icon'></a></div>";	
			}

			$("#content_field").html("");	
			$("#content_field").html(content_field);
		}	
	
		$(document).on('change', '#free_type', function(){
			var val = $.trim($(this).val());
			if(val != ''){
				var label =	$("#free_type option:selected").text();
				var label_content = "";
				label_content += label+"<em>*</em>";
				
				$("#content_label").html("");	
				$("#content_label").html(label_content);

				var content_field = "";
				if(val == 1){ //audio
					content_field += "<input type='file' name='content' class='form-control uploadAudioFile' data-valid='required' />";	
				} else if(val == 2){ //video
					content_field += "<input type='file' name='content' class='form-control uploadVideoFile' data-valid='required' />";	
				} else if(val == 3){ //pdf
					content_field += "<input type='file' name='content' class='form-control uploadFile' data-valid='required' />";	
				}

				$("#content_field").html("");	
				$("#content_field").html(content_field);
			} else {
				$("#content_label").html("");	
				$("#content_field").html("");	
			}
		});
	// Free Downloads End
	
	//Common Functions Start
		//datepicker
			/* $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
			
			$(".from_search").datepicker({
				dateFormat: "yy-mm-dd",
				onSelect: function () {
					var to = $('.to_search');
					var startDate = $(this).datepicker('getDate');

					var minDate = $(this).datepicker('getDate');
					console.log(minDate);
					var toDate = to.datepicker('getDate');
					
					//difference in days. 86400 seconds in day, 1000 ms in second
					var dateDiff = (toDate - minDate)/(86400 * 1000);

					if (toDate == null || dateDiff < 0) {
							to.datepicker('setDate', minDate);
					}
					else if (dateDiff > 30){
							to.datepicker('setDate', startDate);
					}
					to.datepicker('option', 'minDate', minDate);
				}
			});
			$('.to_search').datepicker({
				dateFormat: "yy-mm-dd",
				minDate:  $(".from_search").datepicker('getDate')	
			}); */

		//mask
			/* $(".mask").mask('000-000-0000'); */
			
		//tooltip	
			 $('[data-toggle="tooltip"]').tooltip();
		
		// number vaidation
			$(document).on('keypress', '.number', function(e){
				var charCode;
				if (e.keyCode > 0) {
					charCode = e.which || e.keyCode;
				}
				else if (typeof (e.charCode) != "undefined") {
					charCode = e.which || e.keyCode;
				}
				if (charCode == 46){
					var value = $(this).val(); //last value
					if(value.indexOf(".") != -1){
						return false
					}	
					else{
						return true;
					}
				}
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			});
			
		//file validation for PDF
			$(document).on('change', '.uploadFile', function () {
				var file = this.files[0];
				var fileType = file["type"];
				var ValidImageTypes = ["application/pdf"];
				if ($.inArray(fileType, ValidImageTypes) < 0) 
					{
						$(this).val('');
						$(this).next().remove();	
						$(this).after("<span class='custom-error' role='alert'>Please select only .pdf file.</span>");
						return false;
					}
				else
					{
						var size = (this.files[0].size);
						
						if( size > 51200000 ) //50MB 
							{
								$(this).val('');
								$(this).next().remove();	
								$(this).after("<span class='custom-error' role='alert'>PDF File should be less than 50 MB.</span>");
								return false;
							}
						else
							{
								$(this).next().remove();
							}
					}		
			});
			
		//audio validation 	
			$(document).on('change', '.uploadAudioFile', function () {
				var file = this.files[0];
				var fileType = file["type"];
				var ValidImageTypes = ["audio/mp3", "audio/ogg"];
				if ($.inArray(fileType, ValidImageTypes) < 0) 
					{
						$(this).val('');
						$(this).next().remove();	
						$(this).after("<span class='custom-error' role='alert'>Please select only .mp3, .ogg file.</span>");
						return false;
					}
				else
					{
						var size = (this.files[0].size);
						if( size > 200000000 ) 
							{
								$(this).val('');
								$(this).next().remove();	
								$(this).after("<span class='custom-error' role='alert'>PDF File should be less than 200 MB.</span>");
								return false;
							}
						else
							{
								$(this).next().remove();
							}
					}		
			});
		
		//video validation 	
			$(document).on('change', '.uploadVideoFile', function () {
				var file = this.files[0];
				var fileType = file["type"];
				var ValidImageTypes = ["video/mp4"];
				if ($.inArray(fileType, ValidImageTypes) < 0) 
					{
						$(this).val('');
						$(this).next().remove();	
						$(this).after("<span class='custom-error' role='alert'>Please select only .mp4 file.</span>");
						return false;
					}
				else
					{
						var size = (this.files[0].size);
						if( size > 200000000 ) 
							{
								$(this).val('');
								$(this).next().remove();	
								$(this).after("<span class='custom-error' role='alert'>PDF File should be less than 200 MB.</span>");
								return false;
							}
						else
							{
								$(this).next().remove();
							}
					}		
			});	
			
			
		//image validation
			$(document).on('change', '.uploadImageFile', function () {
				
				var old_image = $("#old_profile_img").val();

				if(typeof old_image == 'undefined' || old_image == '')
					{	
						var default_image_html = "<img class='img-avatar' src='"+site_url+"/public/img/avatars/default_profile.jpg'>";
					}
				else
					{
						var name = $("#old_profile_img").attr('name');
						if(name == 'old_free_img')
							{	
								var default_image_html = "<img class='img-avatar' src='"+site_url+"/public/img/free_downloads/free_imgs/"+old_image+"'>";
							}
						else
							{
								var default_image_html = "<img class='img-avatar' src='"+site_url+"/public/img/profile_imgs/"+old_image+"'>";
							}	
					}
					
				var file = this.files[0];
				var fileType = file["type"];
				var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
				if ($.inArray(fileType, ValidImageTypes) < 0) 
					{
						$(this).val('');
						$(this).next().remove();
						$(".show-uploded-img").html(default_image_html);						
						$(this).after("<span class='custom-error' role='alert'>Please select only .jpg, .jpeg, .gif, .png file.</span>");
						return false;
					}
				else
					{
						var size = (this.files[0].size);
						if( size > 2000000 ) 
							{
								$(this).val('');
								$(this).next().remove();
								$(".show-uploded-img").html(default_image_html);	
								$(this).after("<span class='custom-error' role='alert'>Image File should be less than 2 MB.</span>");
								return false;
							}
						else
							{
								var html = '';
								var reader = new FileReader();
								reader.onload = function (e) {
									
									$(".show-uploded-img").html('');
									
									html += '<img src="" id="currentUploadedImage" class="img-avatar" />';
									
									$(".show-uploded-img").html(html);
									$("#currentUploadedImage").attr('src', e.target.result);
								}
								reader.readAsDataURL(file);
								
								$(this).next().remove();
							}
					}		
			});
			
		//Sample Image Multiple Start	
			$(document).on('change', '.uploadSampleFile', function () {
				$(".sample-images").each(function( index ) {
					$(this).children().removeAttr('id');
				});

				var file = this.files;
				
				var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
				$.each(file, function( index, value ) {
					var fileType = value["type"];
					if ($.inArray(fileType, ValidImageTypes) < 0)
						{
							return false;
						}
					else
						{
							var size = value.size;
							if( size > 2000000 ) 
								{	
									return false;
								}
								else
								{
									var data = new FormData();
									data.append('file', value);	
											
									$.ajax({
											type:'post',
											headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
											url:site_url+'/admin/add_product_sample_image',
											data: data,
											processData: false,
											contentType: false,
											success: function(resp)
												{
													var obj = $.parseJSON(resp);
													if(obj.status == 1)
														{
															var storeFile = $("#storeSampleImage").val();
															if(storeFile == '')
																{
																	$("#storeSampleImage").val(obj.message);
																}
															else
																{
																	var newValue = storeFile+','+obj.message; 
																	$("#storeSampleImage").val(newValue);
																}	
															
															
															
															var reader = new FileReader();
															reader.onload = function (e) {
																var html = '';
																html += '<div class="sample-images col-xs-12 col-sm-12 col-md-4 col-lg-3">';
																html += '<img src="" id="currentUploadedImage'+index+'" class="sample-real-image" /><i class="fa fa-trash deleteImage" data-image="'+obj.message+'"></i>';
																html += '</div>';
															
																$(".all-store-img").append(html);
																$("#currentUploadedImage"+index).attr('src', e.target.result);
															}
															reader.readAsDataURL(value);
														}
													$("#loader").hide();		
												},
											beforeSend: function() {
												$("#loader").show();
											}		
										});
								}	
						}	
				});	
			});
			
		$(document).on('click', '.deleteImage', function(){
			var imageName = $(this).attr('data-image');	
			if($.trim(imageName) != '')
				{
						$.ajax({
								type:'post',
								headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
								url:site_url+'/admin/delete_product_sample_image',
								data: {'image': imageName},
								success: function(resp){
									var obj = $.parseJSON(resp);
									if(obj.status == 1)
										{
											$(".deleteImage[data-image='"+imageName+"']").parent().remove();
											
											var storeFile = $("#storeSampleImage").val();
											
											var arrayStoreFile = storeFile.split(",");	

											var idx = $.inArray(imageName, arrayStoreFile);
											if (idx == -1) 
												{
													//do nothing
												}
											else
												{	
													arrayStoreFile.splice(idx, 1);
												} 
											var lastValue = arrayStoreFile.toString();	
											$("#storeSampleImage").val(lastValue);	
										}
									$("#loader").hide();	
								},
								beforeSend: function() {
									$("#loader").show();
								}
						});						
				}		
		});	
		//Sample Image Multiple End
		
		//ckeditior start
			/* var editor = CKEDITOR.instances['ckeditor'];
			if (editor)
				CKEDITOR.replace( editor, {
					filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
					filebrowserUploadUrl: site_url+'/admin/add_ckeditior_image',
					filebrowserWindowWidth: '1000',
					filebrowserWindowHeight: '700'
				} ); */		
			
	//Common Functions End
	
});





	