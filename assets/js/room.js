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
	
	var addUserForm = $("#room");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			roomtype : { required : true },
			seatcap : { required : true },
			//floors : {required : true},
			//bed : {required : true},
			//chair : {required : true},
			//tables : {required : true},
			//cupboards : {required : true},
			//tubelight : {required : true},
			//fan : {required : true},
			//otheritem : {required : true},
			hostel : { required : true, selected : true}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			roomtype : { required : "This field is required"},
			seatcap : { required : "This field is required" },
			//floors : {required : "This field is required" },
			//bed : {required : "This field is required" },
			//chair : {required : "This field is required" },
			//tables : {required : "This field is required" },
			//cupboards : {required : "This field is required" },
			//tubelight : {required : "This field is required" },
			//fan : {required : "This field is required" },
			//otheritem : {required : "This field is required" },
			hostel : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});
