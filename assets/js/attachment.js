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
	
	var addUserForm = $("#attachment");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			seat : {required : true},
			feeamount : {required : true},
			hostelno : {required : true, selected : true},
			roomtype : {required : true, selected : true},
			status : {required : true, selected : true},
			allotstatus : {required : true, selected : true},
			//seatavilabel: {required : true, selected : true},
			regno: {required : true, selected : true},
			alloted: {required : true, selected : true},
			semcode : {required : true},
			seatoccupy : { required : true, selected : false}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			roomtype : { required : "This field is required", selected : "Please select atleast one option"},
			seat : {required : "This field is required" },
			status : { required : "This field is required", selected : "Please select atleast one option"},
			allotstatus : { required : "This field is required", selected : "Please select atleast one option"},
			//seatavilabel: { required : "This field is required", selected : "Please select atleast one option"},
			hostelno : {required : "This field is required", selected : "Please select atleast one option"},
			regno : {required : "This field is required", selected : "Please select atleast one option"},
			alloted : {required : "This field is required", selected : "Please select atleast one option"},
			semcode :{ required : "This field is required" },
			feeamount :{ required : "This field is required" },
			seatoccupy : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
        //console.log(regno);
		hitURL = baseURL + "attachment/Attachment/VerifyUserRecord", 
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
					   var hostelid = jsonData1[i].HOSTELID;
					   var hostelno = jsonData1[i].HOSTEL_NO;
					   var hosteldesc = jsonData1[i].HOSTELDESC;
					   var roomid = jsonData1[i].ROOMID;
					   var roomdesc = jsonData1[i].ROOMDESC;
					   var roomtype = jsonData1[i].ROOMTYPE;
					   var seatid = jsonData1[i].SEATID;
					   var seat = jsonData1[i].SEAT;
					   var gender = jsonData1[i].GENDER;
					   var expdate = jsonData1[i].EXPIRYDATE;
                    }
					
					$("#studentname").val(studentname);
					$("#hostelid").val(hostelid);
					$("#hostelno").val(hostelno);
					$("#roomid").val(roomid);
					$("#roomno").val(roomdesc);
					$("#roomtype").val(roomtype);
					$("#hostelname").val(hosteldesc);
					$("#seatid").val(seatid);
					$("#seat").val(seat);
					$("#gender").val(gender);
					$("#expdate").val(expdate);
				}
				else
				    {
						
				      alert ("No records exist against this Registration Number.");
					    location.reload();
						request.abort();
					}
                // the next thing you want to do 
            }
			
        });
    })
})

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#attachregno").change(function() {
		var attachregno = $('#attachregno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "attachment/Attachment/VerfiyGuestRegno", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'attachregno':attachregno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
			    //alert(data);
				if(data == 0)
					{
						alert("Sorry! This student have already seat alloted in Allotment/Re-Allotment.");
						$("#attachregno").val('');
						
					}
				else if (data != "[]" && data != 0)
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++)
					 {
                        
						 var attachname = jsonData1[i].STUDENTNAME;
						 var cnic = jsonData1[i].CNIC;
					
                     }
					 $("#attachname").val(attachname);
					 $("#cnic").val(cnic);
					 
				}
				else
				    {
						
				    alert ("No records exist against this Seat.");
					location.reload();
						request.abort();
					}
                // the next thing you want to do 
            }
			
        });
    })
})

/** 
<script>
document.getElementById("fname").onchange = function() {myFunction()};

function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
</script>

**/