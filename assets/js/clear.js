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
	
	var addUserForm = $("#clearance");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			seat : {required : true},
			feeamount : {required : true},
			hostelno : {required : true, selected : true},
			roomtype : {required : true, selected : true},
			cstatus : {required : true, selected : true},
			allotstatus : {required : true, selected : true},
			seatavilabel: {required : true, selected : true},
			regno: {required : true, selected : true},
			alloted: {required : true, selected : true},
			semcode : {required : true},
			depodate : {required : true},
			cleardate : {required : true},
			fine : {required : true},
			//pic1 :{ required : true },
			seatoccupy : { required : true, selected : false}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			fine :{ required : "This field is required" },
			cleardate :{ required : "This field is required" },
			//pic1 :{ required : "This field is required" },
			roomtype : { required : "This field is required", selected : "Please select atleast one option"},
			seat : {required : "This field is required" },
			cstatus : { required : "This field is required", selected : "Please select atleast one option"},
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
		var ldate = $("#leavedate").val();
		var regno = $('#regno').val();
		if(ldate == '')
		{
			alert('Enter leaving date first');
			location.reload();
			request.abort();
		}
        //console.log(regno);
		hitURL = baseURL + "clearance/Clearance/VerifyUserRecord", 
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
					   var hostelno = jsonData1[i].HOSTEL;
					   var hostelid = jsonData1[i].HOSTELID;
					   var roomtype = jsonData1[i].ROOMTYPE;
					   var roomdesc = jsonData1[i].ROOMDESC;
					   var roomid = jsonData1[i].ROOMID;
					   var hosteldesc = jsonData1[i].HOSTELDESC;
					   var seat = jsonData1[i].SEAT;
					   var seatid = jsonData1[i].SEATID;
					   var gender = jsonData1[i].GEN;
					   var quotatype = jsonData1[i].QUOTA_TYPE;
					   var semcode = jsonData1[i].SEMCODE;
					   var allotdate = jsonData1[i].ALLOTEDDATE;
					   var seqid = jsonData1[i].ALLOTMENT_ID;
					   var attachid = jsonData1[i].ATTACHMENT_ID;
					   var radate = jsonData1[i].RADATE;
					   var regno = jsonData1[i].REGNO;
					   var allottype = jsonData1[i].ALLOTTYPE;
					   var semcode = jsonData1[i].SEMCODE;
					   var cupkey = jsonData1[i].CUPBOARDKEYSALLOTED;
					   var drawkey = jsonData1[i].DRAWKEYS;
					   var matress = jsonData1[i].MATRESS;
					   var chair = jsonData1[i].CHAIR;
					   var table = jsonData1[i].TABLES;
					   var expdate = jsonData1[i].EXPIRYDATE;
					   
                    }
var leavdate = $("#leavedate").val();

newdate = leavdate.split("/").reverse().join("-");
expdates = expdate.split("/").reverse().join("-");		
var fullDate = new Date()

//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
 
var currentDate = fullDate.getFullYear() + "," + twoDigitMonth + "," + fullDate.getDate();

//var startdate = expdate.replace(/\//g,",");
//alert(expdates);
//alert(newdate);

var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
var firstDate = new Date(expdates);
var secondDate = new Date(newdate);
var dates = secondDate - firstDate; 
//alert(dates);
var daysDiff = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));

//alert(daysDiff);
			if(daysDiff > 0 && dates > 0)
			{
				var amount = daysDiff*200;
				
				$("#fine").val(amount);
			}
			else
			{
				$("#fine").val('0');
			}
				
				    $("#studentname").val(studentname);
					$("#hostelno").val(hostelno);
					$("#gender").val(gender);
					$("#hostelid").val(hostelid);
					$("#hostelno").val(hostelno);
					$("#hostelname").val(hosteldesc);
					$("#roomno").val(roomdesc);
					$("#roomid").val(roomid);
					$("#roomtype").val(roomtype);
					$("#seat").val(seat);
					$("#seatid").val(seatid);
					$("#seq").val(seqid);
					$("#quotatype").val(quotatype);
					$("#semcode").val(semcode);
					$("#type").val(allottype);
					$("#semcode").val(semcode);
					$("#semcode").val(semcode);
					$("#allotdate").val(allotdate);
					$("#expdate").val(expdate);
					if(cupkey == 1){
					$('#cupkey').html('<option val="1">Yes</option>');
					$('#cupkey').append('<option val="0">No</option>');
					}
					if(drawkey == 1){
					$('#drawkey').html('<option val="1">Yes</option>');
					$('#drawkey').append('<option val="0">No</option>');
					}
					if(matress == 1){
					$('#matress').html('<option val="1">Yes</option>');
					$('#matress').append('<option val="0">No</option>');
					}
					if(chair == 1){
					$('#chair').html('<option val="1">Yes</option>');
					$('#chair').append('<option val="0">No</option>');
					}
					if(table == 1){
					$('#table').html('<option val="1">Yes</option>');
					$('#table').append('<option val="0">No</option>');
					}
					//$("#seatavilabel").html(appenddata1);
					//$("#seatavilabel").append(appenddata1);
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
	
$("#leavedate").change(function() {
var leavdate = $("#leavedate").val();
var expdate = $("#expdate").val();
newdate = leavdate.split("/").reverse().join("-");
expdates = expdate.split("/").reverse().join("-");		
var fullDate = new Date()

//convert month to 2 digits
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
 
var currentDate = fullDate.getFullYear() + "," + twoDigitMonth + "," + fullDate.getDate();

//var startdate = expdate.replace(/\//g,",");
//alert(expdates);
//alert(newdate);

var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
var firstDate = new Date(expdates);
var secondDate = new Date(newdate);

var daysDiff = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
var dates = secondDate - firstDate;
//alert(daysDiff);
			if(daysDiff > 0 && dates > 0)
			{
				var amount = daysDiff*200;
				
				$("#fine").val(amount);
			}
			else
			{
				$("#fine").val('0');
			}
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