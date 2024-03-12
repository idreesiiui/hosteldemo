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
	
	var addUserForm = $("#seatinterchange");
	
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
       // console.log(regno);
		hitURL = baseURL + "seatswap/Interchange/VerifyUserRecord", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'regno':regno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == '"false"')
				{
					  alert ("No records exist against this Registration Number.");
					  location.reload();
				}
				else if (data != '')
				{
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                       var allotmentid = jsonData1[i].REALLOTMENT_ID;
					   var studentname = jsonData1[i].STUDENTNAME;
					   var hostelno = jsonData1[i].HOSTEL_NO;
					   var hostelname = jsonData1[i].HOSTELDESC;
					   var roomno = jsonData1[i].ROOMDESC;
					   var roomtype = jsonData1[i].ROOMTYPE;
					   var seat = jsonData1[i].SEAT;
					   var gender = jsonData1[i].GENDER;
					  
                    }
					
					//window.location.reload(true);
					//$('#allotmentid').empty('<img  width = "100" height = "100" src="../../uploads/image/' + allotmentid + '.jpg">');
					//$('#allotmentid').append('<img  width = "100" height = "100" src="../../uploads/image/' + allotmentid + '.jpg">');
					$("#img").hide();
					$(".box-footer").hide();
					//$("#allotmentid").val(allotmentid);
					$("#studentname").val(studentname);
					$("#hostelno").val(hostelno);
					$("#hostelname").val(hostelname);
					$("#roomno").val(roomno);
					$("#roomtype").val(roomtype);
					$("#seat").val(seat);
					$("#gender").val(gender);
					$("#btn").show();
					
				}
				
                // the next thing you want to do 
            }
			
        });
    })
})


$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#swapregno").change(function() {
		var regno = $('#swapregno').val();
       // console.log(regno);
		hitURL = baseURL + "seatswap/Interchange/VerifyUserRecord", 
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
                       var allotmentid = jsonData1[i].REALLOTMENT_ID;
					   var studentname = jsonData1[i].STUDENTNAME;
					   var hostelno = jsonData1[i].HOSTEL_NO;
					   var hostelname = jsonData1[i].HOSTELDESC;
					   var roomno = jsonData1[i].ROOMDESC;
					   var roomtype = jsonData1[i].ROOMTYPE;
					   var seat = jsonData1[i].SEAT;
					   var gender = jsonData1[i].GENDER;
                    }
					
					<!--$('#swapallotmentid').append('<img  width = "100" height = "100" src="../../uploads/image/' + allotmentid + '.jpg">');-->
					$("#swapimg").hide();
					//$("#allotmentid").val(allotmentid);
					$("#swapstudentname").val(studentname);
					$("#swaphostelno").val(hostelno);
					$("#swaphostelname").val(hostelname);
					$("#swaproomno").val(roomno);
					$("#swaproomtype").val(roomtype);
					$("#swapseat").val(seat);
					$("#swapgender").val(gender);
					//$("#btn").show();
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
    $("#vhostelno").change(function() {
		var hostelno = $('#vhostelno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "seatswap/Interchange/GetHostelInfoByHNO", 
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

					 $("#vhostelname").val(hosteldesc);
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
    $("#vhostelno").change(function() {
	   var hostelno = $('#vhostelno').val();
       //console.log(hostelno);
		hitURL = baseURL + "seatswap/Interchange/GetRoomInfoByHNO", 
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
					$('#vroomno').html('<option value=""> Select Room No</option>');
                    
					$("#vroomno").append(appenddata1);

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
    $("#vroomno").change(function() {
		var roomno = $('#vroomno').val();
		var hostelno = $('#vhostelno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "seatswap/Interchange/getRoomInfobyId", 
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
                      
						 var roomtype = jsonData1[i].ROOMTYPE;
						
                    }

					 $("#vroomtype").val(roomtype);
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
    $("#vroomno").change(function() {
		var hostelno = $('#vhostelno').val();
		var roomno = $('#vroomno').val();
       //alert(hostelno);
		hitURL = baseURL + "seatswap/Interchange/GetSeatByRIdHId", 
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
					$('#vseat').html('<option value=""> Select  Vacant Seat</option>');
                    $("#vseat").append(appenddata1);

				}
				else
				    {
						
				    alert ("No Seat exist against Selected Hostel No and Room No.");
					$('#vseat').html('<option value=""> </option>');
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
	
$('#interchange').click(function(){
  $("#vacantdetail").hide();
  $("#swap").show();
  $(".box-footer").show();
});
$('#vacant').click(function(){
  $("#swap").hide();
  $("#vacantdetail").show();
  $(".box-footer").show();
});