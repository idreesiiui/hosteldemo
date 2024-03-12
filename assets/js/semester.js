/**
 * File : semester.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addsemesterForm = $("#semester");
	
	var validator = addsemesterForm.validate({
		
		rules:{
			smstartdate :{ required : true},
			smenddate : { required : true},
			startregdate : { required : true},
			smecode  : { required : true},
			endregdate : {required : true}
			
		},
		messages:{
			smecode :{ required : "This field is required" },
			smstartdate :{ required : "This field is required" },
			smenddate : { required : "This field is required" },
			startregdate : { required : "This field is required" },
			endregdate : {required : "This field is required"}
						
		}
	});
	
	
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
	
});
