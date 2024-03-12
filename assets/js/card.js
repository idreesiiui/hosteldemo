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
	
	var addUserForm = $("#card");
	
	var validator = addUserForm.validate({
		
		rules:{
			cardno :{ required : true },
			regno : {required : true},
			studentname : {required : true},
			gender : {required : true},
			hostelname : {required : true, selected : true},
			hostelno : {required : true, selected : true},
			roomno : {required : true, selected : true},
			seatno : {required : true, selected : true},
			issuedate: {required : true, selected : true}
		},
		messages:{
			cardno :{ required : "This field is required" },
			regno :{ required : "This field is required" },
			studentname : { required : "This field is required" },
			gender : {required : "This field is required" },
			hostelname : { required : "This field is required" },
			hostelno : { required : "This field is required" },
			roomno : {required : "This field is required" },
			seatno : {required : "This field is required" },
			issuedate : {required : "This field is required" }			
		}
	});
	
	$('#cnic').keydown(function(){
 
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

function pic1readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pic1')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

/** 
<script>
document.getElementById("fname").onchange = function() {myFunction()};

function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
</script>

**/