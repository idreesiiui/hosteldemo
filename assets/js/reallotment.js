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
	
	var addUserForm = $("#reallotment");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
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

$(document).ready(function(){
	
	var addUserForm = $("#freallotadmin");
	
	var validator = addUserForm.validate({
		
		rules:{
			regno :{ required : true },
			name : {required : true},
			faculty : {required : true},
			dept : {required : true},
			programe : {required : true},
			cgpa : {required : true},
			email : { required : true, email : true },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			semcode : {required : true},
		},
		messages:{
			regno :{ required : "This field is required" },
			name : { required : "This field is required"},
			faculty : {required : "This field is required" },
			dept : {required : "This field is required" },
			programe : {required : "This field is required" },
			cgpa : {required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			semcode : {required : "This field is required" },
					
		}
	});	
});


$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
       //console.log(regno);
		hitURL = "http://usis.iiu.edu.pk:64453/freallot/VerifyUserRecord", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'regno':regno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				console.log(data);
				//alert(data);
				if (data != "[]")
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                       var studentname = jsonData1[i].STUDENTNAME;
					   var fathername = jsonData1[i].FATHERNAME;
					   var gender = jsonData1[i].GENDER;
					   var faculty = jsonData1[i].FACULTY;
					   var dept = jsonData1[i].DEPARTMENTNAME;
					   var programe = jsonData1[i].PROGRAME;
					   var cgpa = jsonData1[i].CGPA;
                    }
					var cgpa = Number(cgpa).toFixed(2);
					if(gender == 'F')
					{
						var gender = 'Female';
					}
					else
					{var gender = 'Male';}
					$("#name").val(studentname);
					$("#fathername").val(fathername);
					$("#gender").val(gender);
					$("#faculty").val(faculty);
					$("#dept").val(dept);
					$("#programe").val(programe);
					$("#cgpa").val(cgpa);
					
				}
				else
				    {
						
				    alert ("No records exist against this Registration Number.");
					}
                // the next thing you want to do 
            }
			
        });
    })
})

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#seatavilabel").change(function() {
		var seatavilabel = $('#seatavilabel').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "allotment/Allotment/GetseatInfoById", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'seatavilabel':seatavilabel},
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
                        
						 var roomno = jsonData1[i].ROOMID;
						 var hostelno = jsonData1[i].HOSTEL_NO;
						 var hosteldesc = jsonData1[i].HOSTELDESC;
						 var roomdesc = jsonData1[i].ROOMDESC;
						
                    }
					 $("#roomno").val(roomno);
					 $("#roomname").val(roomdesc);
					 $("#hostelno").val(hostelno);
					 $("#hostelname").val(hosteldesc);
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

/** 
<script>
document.getElementById("fname").onchange = function() {myFunction()};

function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
</script>

**/