
$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
   $(".selectboxit").change(function(){
	//alert($(this).val());
	var status = $(this).val();
	//alert (status);
       //console.log(regno);
		hitURL = baseURL + "report/reports/UpdateUserStatus", 
		$.ajax({
            type:'POST',
			url : hitURL,
			cache:false,
            data:{'status':status},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				
				if (data == "1")
				{
					var data = 'Record Updated Sucessfully'; 
				  $('#feedback').html(data);
				  $('#feedback').show(2500);
				  $('#feedback').fadeOut(2500);
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