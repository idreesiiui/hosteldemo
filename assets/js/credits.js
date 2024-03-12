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
	
	var addUserForm = $("#credits");
	
	var validator = addUserForm.validate({
		
		rules:{
			bscredit :{ required : true },
			macredit : { required : true},
			mscredit : { required : true},
			phdcredit : {required : true},
			bscreditfor : { required : true},
			macreditfor : { required : true},
			mscreditfor : { required : true},
			phdcreditfor : { required : true},
			semcode : { required : true},
			status : { required : true, selected : false},
			type : { required : true, selected : true}
		},
		messages:{
			bscredit :{ required : "This field is required", selected : "Please select atleast one option" },
			macredit : { required : "This field is required", selected : "Please select atleast one option"},
			mscredit : { required : "This field is required", selected : "Please select atleast one option" },
			phdcredit : {required : "This field is required", selected : "Please select atleast one option" },
			bscreditfor : { required : "This field is required", selected : "Please select atleast one option" },
			macreditfor : { required : "This field is required", selected : "Please select atleast one option" },
			sscreditfor : { required : "This field is required", selected : "Please select atleast one option" },
			phdcreditfor : { required : "This field is required", selected : "Please select atleast one option" },
			semcode : { required : "This field is required" },
			status : { required : "This field is required", selected : "Please select atleast one option" },
			type : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

