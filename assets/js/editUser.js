/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function(){
	
	var editUserForm = $("#editUser");
	
	var validator = editUserForm.validate({
		
		rules:{
			cnic :{ required : true, alphanumeric: true },
			email : { required : true, email : true },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true},
			gender : { required : true, selected : true}
		},
		messages:{
			cnic :{ required : "This field is required", alphanumeric : "Only alpha numeric values"  },
			email : { required : "This field is required", email : "Please enter valid email address" },
			cpassword : {equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" },
			gender : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
		jQuery.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
		}, "Letters, numbers, and underscores only please");
});