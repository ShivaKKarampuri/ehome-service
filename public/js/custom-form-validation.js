var requiredError = 'This field is required.';
var emailError = "Please enter the valid email address.";
var maxError = "Number should be less than or equal to ";
var min = "This field should be greater than or equal to ";
var max = "This field should be less than or equal to ";
var equal = "This field should be equal to ";

function customValidate(formName)
	{
		$(".loader").show(); //all form submit
		
		var i = 0;	
		$(".invalid-feedback").remove(); //remove all errors when submit the button
		
		$("form[name="+formName+"] :input[data-valid]").each(function(){
			var dataValidation = $(this).attr('data-valid');
			var splitDataValidation = dataValidation.split(' ');
			
			var j = 0; //for serial wise errors shown	
			if($.inArray("required", splitDataValidation) !== -1) //for required
				{
					var for_class = $(this).attr('class');	
					if(for_class.indexOf('multiselect_subject') != -1)
						{
							var value = $.trim($(this).val());	
							if (value.length === 0) 
								{
									i++;
									j++;
									$(this).parent().after(errorDisplay(requiredError)); 
									$(this).addClass('is-invalid'); 
								}	
						}  
					else 
						{
							if( !$.trim($(this).val()) ) 
								{
									i++;
									j++;
									$(this).after(errorDisplay(requiredError));  
									$(this).addClass('is-invalid'); 
								}
						}
				}
			if(j <= 0)
				{
					if($.inArray("email", splitDataValidation) !== -1) //for email
						{
							if(!validateEmail($.trim($(this).val()))) 
								{
									i++;
									$(this).after(errorDisplay(emailError));  
									$(this).addClass('is-invalid'); 
								}
						}
							
					var forMin = splitDataValidation.find(a =>a.includes("min"));
					if(typeof forMin != 'undefined')
						{
							var breakMin = forMin.split('-');
							var digit = breakMin[1];

							var value = $.trim($(this).val()).length;
							if(value < digit) 
								{
									i++;
									$(this).after(errorDisplay(min+' '+digit+' character.'));  
									$(this).addClass('is-invalid'); 
								}	
						}
						
					var forMax = splitDataValidation.find(a =>a.includes("max"));
					if(typeof forMax != 'undefined')
						{
							var breakMax = forMax.split('-');
							var digit = breakMax[1];

							var value = $.trim($(this).val()).length;
							if(value > digit) 
								{
									i++;
									$(this).after(errorDisplay(max+' '+digit+' character.'));  
								}	
						}
						
					var forEqual = splitDataValidation.find(a =>a.includes("equal"));
					if(typeof forEqual != 'undefined')
						{
							var breakEqual = forEqual.split('-');
							var digit = breakEqual[1];

							var value = ($.trim($(this).val()).replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-')).length;
							if(value != digit) 
								{
									i++;
									$(this).after(errorDisplay(equal+' '+digit+' character.'));  
								}	
						}
				}			
		});
		
		if(i > 0)
			{
				if(formName != 'upload-answer')	{
					$('html, body').animate({scrollTop:0}, 'slow');
				}
				$(".loader").hide();
				return false;
			}	
		else
			{
				if(formName == 'submit-review')
					{
						$("form[name=submit-review] :input[data-max]").each(function(){
							var data_max  = $(this).attr('data-max');
							var value = $.trim($(this).val());	
							if(parseInt(value) > parseInt(data_max))	
								{
									$(this).after(errorDisplay(maxError + data_max)); 
									$(".loader").hide();
									return false;	
								}
							else
								{
									$("form[name="+formName+"]").submit();
									return true;
								}	
						});	
					}
				else
					{	
						$("form[name="+formName+"]").submit();
						return true;	
					}
			}	
		
	}	
	
function errorDisplay(error) {
	return "<span class='invalid-feedback' role='alert'>"+error+"</span>";
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
		return true;
	}
    else {
		return false;
    }
} 