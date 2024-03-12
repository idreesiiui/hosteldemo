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
	
	var addUserForm = $("#blacklist");
	
	var validator = addUserForm.validate({
		
		rules:{
	        regno :{ required : true },
			sname : {required : true},
			fname : {required : true},
			cnic : {required : true},
			dob : {required : true},
			status : {required : true, selected : true}
			//pic1 :{ required : true },
		},
		messages:{
			regno :{ required : "This field is required" },
			status : {required : "This field is required", selected : "Please select atleast one option"},
			sname :{ required : "This field is required" },
			fname :{ required : "This field is required" },
			dob :{ required : "This field is required" },
			cnic :{ required : "This field is required" }
			//pic1 :{ required : "This field is required" },
		}
	});	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
       // console.log(regno);
		hitURL = baseURL + "blacklist/blacklist/VerifyUserRecord", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'regno':regno},
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
                       var studentname = jsonData1[i].STUDENTNAME;
					   var fathername = jsonData1[i].FATHERNAME;
					   var cnic = jsonData1[i].CNIC;
					   var dob = jsonData1[i].STUDENTDOB;
					   var gender = jsonData1[i].GENDER;
                    }
	
					$("#sname").val(studentname);
					$("#fname").val(fathername);
					$("#cnic").val(cnic);
					$("#dob").val(dob);
				}
				else
				    {
						
				    alert ("No records exist against this Registration Number.");
					}
                // the next thing you want to do 
            }
			
        });
    });
});

function pic1readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pic1')
                        .attr('src', e.target.result)
                        .width(105)
                        .height(105);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }