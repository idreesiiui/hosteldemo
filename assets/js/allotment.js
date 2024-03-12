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
	
	var addUserForm = $("#allotment");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			seat : {required : true},
			feeamount : {required : true},
			hostelno : {required : true, selected : true},
			roomtype : {required : true, selected : true},
			status : {required : true, selected : true},
			allotstatus : {required : true, selected : true},
			seatavilabel: {required : true, selected : true},
			regno: {required : true, selected : true},
			alloted: {required : true, selected : true},
			semcode : {required : true},
			depodate : {required : true},
			//pic1 :{ required : true },
			seatoccupy : { required : true, selected : false}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			//pic1 :{ required : "This field is required" },
			roomtype : { required : "This field is required", selected : "Please select atleast one option"},
			seat : {required : "This field is required" },
			status : { required : "This field is required", selected : "Please select atleast one option"},
			allotstatus : { required : "This field is required", selected : "Please select atleast one option"},
			seatavilabel: { required : "This field is required", selected : "Please select atleast one option"},
			hostelno : {required : "This field is required", selected : "Please select atleast one option"},
			regno : {required : "This field is required", selected : "Please select atleast one option"},
			alloted : {required : "This field is required", selected : "Please select atleast one option"},
			semcode :{ required : "This field is required" },
			feeamount :{ required : "This field is required" },
			depodate :{ required : "This field is required" },
			seatoccupy : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
       //console.log(regno);
		hitURL = baseURL + "allotment/Allotment/VerifyUserRecord", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'regno':regno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! Invalid RegNo');
						location.reload();
				}
				else if (data != '')
				{
					if(data == 1)
					{
						alert('Oops! Allotement already Existed in Database');
						location.reload();
					}
					else if(data == 2)
					{
						alert('Oops! Student Exist in ReAllotment');
						location.reload();
					}
					else if(data == 3)
					{
						alert('Oops! Student Exist in BlackList');
						location.reload();
					}
					else if(data == 4)
					{
						alert('Oops! Student Exist in AllotReallot');
						location.reload();
					}
					else{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
					var email = jsonData1[0].STUDENTEMAIL;
					// Male side allotment first time Start
					if(email == null)
					  {
						  var email = $("#email").val();
					  }
					  // Male side allotment first time end
                    for (var i = 0; i < jsonData1.length; i++) {
                       var studentname = jsonData1[i].STUDENTNAME;
					   var fathername = jsonData1[i].FATHERNAME;
					   var address = jsonData1[i].PERMANENT;
					   var preadd = jsonData1[i].PREADD;
					   var studentnumber = jsonData1[i].STUDENTNUMBER;
					   var dob = jsonData1[i].STUDENTDOB;
					   var batchname = jsonData1[i].SEMESTERCODE;
					   var deptname = jsonData1[i].DEPARTMENTNAME;
					   var programe = jsonData1[i].PROGRAME;
					   var protittle = jsonData1[i].ACADPROGLEVEL;
					   var protittles = jsonData1[i].PROTITTLE;
					   var faculty = jsonData1[i].FACULTY;
					   var nationality = jsonData1[i].NATIONALITY;
					   var gender = jsonData1[i].GENDER;
					   var country = jsonData1[i].COUNTRY;
					   var district = jsonData1[i].DISTRICT;
					   var cnic = jsonData1[i].CNIC;
					   var programe = jsonData1[i].PROGRAME;
					   var batchname = jsonData1[i].BATCHNAME;
					   var allotmentid = jsonData1[i].ALLOTMENT_ID;
					   
					  }
                    }
					if(protittle == '')
					{
						var progtittle = protittle;
						
					}
					else
					{
						var progtittle = protittles;
					
					}
	
					$("#studentname").val(studentname);
					$("#fname").val(fathername);
					$("#address").val(address);
					$("#preadd").val(preadd);
					$("#phone").val(studentnumber);
					$("#dob").val(dob);
					$("#bname").val(batchname);
					$("#dname").val(deptname);
					$("#program").val(programe);
					$("#faculty").val(faculty);
					$("#nationality").val(nationality);
					$("#gend").val(gender);
					$("#country").val(country);
					$("#protittle").val(progtittle);
					$("#district").val(district);
					$("#cnic").val(cnic);
					$("#email").val(email);
					$("#programe").val(programe);
					$("#batchname").val(batchname);
					$('#allotmentid').append('<img  width = "100" height = "100" src="../../uploads/image/' + allotmentid + '.jpg">');
				}
				else
				    {
						
				    alert ("No records exist against this Registration Number.");
					location.reload();
					}
                // the next thing you want to do 
            }
			
        });
    })
})

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "allotment/Allotment/GetFeechallanInfo", 
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
                    for (var i = 0; i < jsonData1.length; i++)
					 {
                      
						 var challanno = jsonData1[i].CHALLANNO;
						 var feeamount = jsonData1[i].FEEAMOUNT;
						
                    }

					 $("#recpno").val(challanno);
					 $("#feeamount").val(feeamount);
				}
				else 
				    {
						
				      $("#feeamount").val('0');
					}
                // the next thing you want to do 
            }
			
        });
    });
});


$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#hostelno").change(function() {
		var hostelno = $('#hostelno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "allotment/Allotment/GetHostelInfoByHNO", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno},
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
                      
						 var hosteldesc = jsonData1[i].HOSTELDESC;
						
                    }

					 $("#hostelname").val(hosteldesc);
				}
				else 
				    {
						
				    alert ("No records exist against this Hostel No.");
					}
                // the next thing you want to do 
            }
			
        });
    })
})

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#hostelno").change(function() {
	   var hostelno = $('#hostelno').val();
       //console.log(hostelno);
		hitURL = baseURL + "allotment/Allotment/GetRoomInfoByHNO", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno},
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
                        appenddata1 += "<option value = '" + jsonData1[i].ROOMID + " '>" + jsonData1[i].ROOMDESC + " </option>";
                    }
					$('#roomno').html('<option value=""> Select Room No</option>');
                    
					$("#roomno").append(appenddata1);

				}
				else
				    {
						
				    alert ("No Room Number exist against this Hostel No.");
					}
                // the next thing you want to do 
            }
			
        });
    })
})
$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#roomno").change(function() {
		var roomno = $('#roomno').val();
		var hostelno = $('#hostelno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "allotment/Allotment/getRoomInfobyId", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno,'roomno':roomno},
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
                      
						 var roomdesc = jsonData1[i].ROOMTYPE;
						
                    }

					 $("#roomname").val(roomdesc);
				}
				else
				    {
						
				    alert ("No records exist against this Room No.");
					}
                // the next thing you want to do 
            }
			
        });
    })
})
$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#roomno").change(function() {
		var hostelno = $('#hostelno').val();
		var roomno = $('#roomno').val();
       //alert(hostelno);
		hitURL = baseURL + "allotment/Allotment/GetSeatByRIdHId", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno,'roomno':roomno},
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
                        appenddata1 += "<option value = '" + jsonData1[i].SEATID + " '>" + jsonData1[i].SEAT + " </option>";
                    }
					$('#seatavilabel').html('<option value=""> Select  Vacant Seat</option>');
                    $("#seatavilabel").append(appenddata1);

				}
				else
				    {
						
				    alert ("No Seat exist against Selected Hostel No and Room No.");
					$('#seatavilabel').html('<option value=""> </option>');
					}
                // the next thing you want to do 
            }
			
        });
    })
})

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