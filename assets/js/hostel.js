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
	
	var addUserForm = $("#hostel");
	
	var validator = addUserForm.validate({
		
		rules:{
			hosteldesc :{ required : true },
			roomcap : { required : true },
			seatcap : { required : true },
			floors : {required : true},
			gender : { required : true, selected : true}
		},
		messages:{
			hosteldesc :{ required : "This field is required" },
			roomcap : { required : "This field is required"},
			seatcap : { required : "This field is required" },
			floors : {required : "This field is required" },
			gender : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

