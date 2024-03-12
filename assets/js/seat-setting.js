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
	
	var addUserForm = $("#seatsearchList");
	
	var validator = addUserForm.validate({
		
		rules:{
			hostelno : {required : true, selected : true}
		},
		messages:{
			hostelno : {required : "This field is required", selected : "Please select atleast one option"},
		    	 }
	});	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#hostelno").change(function() {
		var hostelno = $('#hostelno').val();
       // console.log(hostelno);
		hitURL = baseURL + "seat/Seat/getroombyHostelId", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'hostelno':hostelno},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
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