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
	
	var addUserForm = $("#seat");
	
	var validator = addUserForm.validate({
		
		rules:{
			roomdesc :{ required : true },
			seat : {required : true},
			hostelno : {required : true, selected : true},
			roomtype : {required : true, selected : true},
			seatoccupy : { required : true, selected : false}
		},
		messages:{
			roomdesc :{ required : "This field is required" },
			roomtype : { required : "This field is required", selected : "Please select atleast one option"},
			seat : {required : "This field is required" },
			hostelno : {required : "This field is required", selected : "Please select atleast one option"},
			seatoccupy : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#hostelno").change(function() {
		var hostelno = $('#hostelno').val();
        console.log(hostelno);
		hitURL = baseURL + "seat/Seat/getroombyHostelId", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				console.log(data);
				//alert(data);
				
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].ROOMID + " '>" + jsonData1[i].ROOMDESC + " </option>";
                    }
					$('#roomno').html('<option value=""> Select Room</option>');
                    $("#roomno").append(appenddata1);
           
				
                // the next thing you want to do 
            }
			
        });
    })
})