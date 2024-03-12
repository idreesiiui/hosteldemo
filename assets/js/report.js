/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#regform");
	
	var validator = addUserForm.validate({
		
		rules:{
			
			status : { required : true, selected : true}
		},
		messages:{
			
			status : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});
