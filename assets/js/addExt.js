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
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true },
			email : { required : true, email : true },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true},
			gender : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" },
			gender : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#studenttype").change(function() {
		var studenttype = $('#studenttype').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "setting/settings/GetdegreeByStdType", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'studenttype':studenttype},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
			    //alert(data);
				if (data != "[]")
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++)
					 {
                      
						 appenddata1 += "<option value = '" + jsonData1[i].name + " '>" + jsonData1[i].name + " </option>";
						 //var noofyear = jsonData1[i].noofyear;
						
                    }
					  $('#programe').html('<option value=""> Select Degree Tittle</option>');
                    
					  $("#programe").append(appenddata1);
					 
					  //$("#noofyear").val(noofyear);
				}
				else 
				    {
						
				    alert ("No records exist against this Student type.");
					}
                // the next thing you want to do 
            }
			
        });
    });
});


$(document).ready(function() {
    $("#programe").change(function() {
		var programe = $('#programe').val();
		var studenttype = $('#studenttype').val();
		hitURL = baseURL + "setting/settings/Getdegreeduration", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'programe':programe, 'studenttype':studenttype},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
			    //alert(data);
				if (data != "[]")
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++)
					 {
						 var noofyear = jsonData1[0].noofyear;
                     }
					 
					  $("#noofyear").val(noofyear);
				}
				else 
				    {
						
				    alert ("No records exist against this Student type.");
					}
                // the next thing you want to do 
            }
			
        });
    });
});
