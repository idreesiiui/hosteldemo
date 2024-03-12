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
	
	var addUserForm = $("#borderList");
	
	var validator = addUserForm.validate({
		
		rules:{
			hostel :{ required : true },
			semester :{ required : true }
		},
		messages:{
			hostel : { required : "This field is required", selected : "Please select atleast one option" },
			semester : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#faculty").change(function() {
		var facid = $('#faculty').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "report/reports/getdepartByFaculty", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'facid':facid},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
			    //alert(data);
				if (data != "[]")
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].DNAME + " '>" + jsonData1[i].DNAME + " </option>";
                    }
					$('#dept').html('<option value="All"> All</option>');
                    $("#dept").append(appenddata1);
           
		
				}
				else
				    {
						
				    alert ("No records exist against this Seat.");
					}
                // the next thing you want to do 
            }
			
        });
    })
})