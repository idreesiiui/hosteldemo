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
	
	var addUserForm = $("#regbox");
	
	var validator = addUserForm.validate({
		
		rules:{
			regno :{ required : true }
		},
		messages:{
			fname :{ required : "Enter Valid Registration Number." }		
		}
	});
});
