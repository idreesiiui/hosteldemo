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
	
	var addUserForm = $("#visitor");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			seat : {required : true},
			vdate : {required : true},
			feeamount : {required : true},
			hostelno : {required : true, selected : true},
			roomtype : {required : true, selected : true},
			status : {required : true, selected : true},
			allotstatus : {required : true, selected : true},
			//seatavilabel: {required : true, selected : true},
			regno: {required : true, selected : true},
			alloted: {required : true, selected : true},
			cnic : {required : true},
			seatoccupy : { required : true, selected : false}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			vdate :{ required : "This field is required" },
			roomtype : { required : "This field is required", selected : "Please select atleast one option"},
			seat : {required : "This field is required" },
			status : { required : "This field is required", selected : "Please select atleast one option"},
			allotstatus : { required : "This field is required", selected : "Please select atleast one option"},
			//seatavilabel: { required : "This field is required", selected : "Please select atleast one option"},
			hostelno : {required : "This field is required", selected : "Please select atleast one option"},
			regno : {required : "This field is required", selected : "Please select atleast one option"},
			alloted : {required : "This field is required", selected : "Please select atleast one option"},
			cnic :{ required : "This field is required" },
			feeamount :{ required : "This field is required" },
			seatoccupy : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
	
	/*$('#cnic').keydown(function(){
 
  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();
 
  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');
 
 });
	
		
});*/

$('#cnic2').keydown(function(){
 
  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();
 
  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');
 
 });




$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regnos").change(function() {
		var regno = $('#regno').val();
       //console.log(seatavilabel);
		hitURL = baseURL + "visitor/Visitor/VerifyUserRecord", 
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