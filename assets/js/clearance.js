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

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
     // alert(regno);
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
				var doorkey = "";
				cupboardkey = "";
				rdues = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                       var studentname = jsonData1[i].STUDENTNAME;
					   var hostelid = jsonData1[i].HOSTELID;
					   var roomid = jsonData1[i].ROOMID;
					   var roomdesc = jsonData1[i].ROOMDESC;
					   var hosteldesc = jsonData1[i].HOSTELDESC;
					   var seatno = jsonData1[i].SEATID;
					   var gender = jsonData1[i].GENDER;
					   var quotatype = jsonData1[i].QUOTA_TYPE;
					   var semcode = jsonData1[i].SEMCODE;
					   var allotdate = jsonData1[i].ALLOTEDDATE;
					   var seqid = jsonData1[i].ALLOTMENT_ID;
					   var attachid = jsonData1[i].ATTACHMENT_ID;
					  var radate = jsonData1[i].RADATE;
					  var regno = jsonData1[i].REGNO;
rdues += "<option value = '" + jsonData1[i].RDUES + " '>" + jsonData1[i].RDUES + " </option>";
					   
doorkey += "<option value = '" + jsonData1[i].DOORKEYSALLOTED + " '>" + jsonData1[i].DOORKEYSALLOTED + " </option>";
cupboardkey += "<option value = '" + jsonData1[i].CUPBOARDKEYSALLOTED + " '>" + jsonData1[i].CUPBOARDKEYSALLOTED + " </option>";
					   var cupboard = jsonData1[i].CUPBOARDKEYSALLOTED;
					   var door = jsonData1[i].DOORKEYSALLOTED;
					   var arriers = jsonData1[i].RDUES;
					   var stregno = jsonData1[i].REGNO;
                    }
					
					$("#studentname").val(studentname);
					$("#hostelno").val(hostelid);
					//$("#seatavilabel").html(appenddata1);
					//$("#seatavilabel").append(appenddata1);
					$("#roomno").val(roomid);
					$("#roomname").val(roomdesc);
					$("#hostelname").val(hosteldesc);
					$("#seatno").val(seatno);
					$("#gender").val(gender);
					$("#quotatype").val(quotatype);
					$("#semcode").val(semcode);
					
					//$("#seq").val(seqids);
					$("#arriers").val(arriers);
					
					if(radate == null)
					{$("#allotdate").val(allotdate);}
					else if(allotdate == null)
					{$("#allotdate").val(radate);}
					
					if(seqid == null)
					{$("#seq").val(attachid);}
					else if(attachid == null)
					{$("#seq").val(seqid);}
					
					if(door == 1){
					$('#doorkey').html('<option val="doorkey">Yes</option>');
					$('#doorkey').append('<option val="0">No</option>');
					}
					else 
				      { 
						 $('#doorkey').html('<option val="doorkey">No</option>');
						 $('#doorkey').append('<option val="1">Yes</option>');
					  }
					  
					if(cupboard == 1){
					$('#cupkey').html('<option val="cupboardkey">Yes</option>');
					$('#cupkey').append('<option val="0">No</option>');
					}
					else 
				      { 
						 $('#cupkey').html('<option val="cupboardkey">No</option>');
						 $('#cupkey').append('<option val="1">Yes</option>');
					  }
					  
					if(arriers != 0){
					$('#arriers').html('<option val="rdues">Yes</option>');
					//$('#arriers').append('<option val="0">No</option>');
					}
					else 
				      { 
						 $('#arriers').html('<option val="rdues">No</option>');
						 //$('#arriers').append('<option val="1">Yes</option>');
					  }
					  
					    
					if(stregno == regno){
					$('#type').html('<option val="Alloted">Alloted</option>');
					//$('#arriers').append('<option val="0">No</option>');
					}
					else 
				      { 
						 $('#type').html('<option val="Attachi">Attachi</option>');
						 //$('#arriers').append('<option val="1">Yes</option>');
					  }
					
					//$('#doorkey').html(doorkey);
					//$('#doorkey').append(doorkey);
					var regno = regno;
					hitURL = baseURL + "clearance/Clearance/GetroomitemByRegno";
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
                        
						 var itemid = jsonData1[i].ITEM_ID;
						 var doorkey = jsonData1[i].DOORKEYSALLOTED;
						 var cupkey = jsonData1[i].CUPBOARDKEYSALLOTED;
						 var drawkey = jsonData1[i].DRAWKEYS;
						 var matress = jsonData1[i].MATRESS;
						 var chair = jsonData1[i].CHAIR;
						 var tables = jsonData1[i].TABLES;
						
                    }
					 
				    if(doorkey == 1){
					$('#doorkey').html('<option val="doorkey">Given</option>');
					$('#doorkey').append('<option val="0">Return</option>');
					$('#doorkey').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#doorkey').html('<option val="doorkey">Not Given</option>');
						 
					  }
					  
					if(cupkey == 1){
					$('#cupkey').html('<option val="cupkey">Given</option>');
					$('#cupkey').append('<option val="0">Return</option>');
					$('#cupkey').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#cupkey').html('<option val="cupkey">Not Given</option>');
						 
					  }
					  
					if(drawkey == 1){
					$('#drawkey').html('<option val="drawkey">Given</option>');
					$('#drawkey').append('<option val="0">Return</option>');
					$('#drawkey').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#drawkey').html('<option val="doorkey">Not Given</option>');
						 
					  }
					  
					if(matress == 1){
					$('#matress').html('<option val="matress">Given</option>');
					$('#matress').append('<option val="0">Return</option>');
					$('#matress').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#matress').html('<option val="matress">Not Given</option>');
						 
					  }
					  
					if(chair == 1){
					$('#chair').html('<option val="chair">Given</option>');
					$('#chair').append('<option val="0">Return</option>');
					$('#chair').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#chair').html('<option val="chair">Not Given</option>');
						 
					  }
					  
					if(tables == 1){
					$('#table').html('<option val="tables">Given</option>');
					$('#table').append('<option val="0">Return</option>');
					$('#table').append('<option val="1">Not Return</option>');
					}
					else 
				      { 
						 $('#table').html('<option val="tables">Not Given</option>');
						 
					  }
					
					 /*$("#roomno").val(doorkey);
					 $("#roomname").val(cupkey);
					 $("#hostelno").val(drawkey);
					 $("#hostelname").val(matress);
					 $("#hostelname").val(chair);
					 $("#hostelname").val(tables);*/
				}
				else
				    {
						
				    alert ("No Items existed against this Reistration number.");
					}
                // the next thing you want to do 
            }
			
        });
					
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