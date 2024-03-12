/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".clear", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "report/reports/gendefaultlist",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to Vacant All seat and make defaulter to all below Students ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("defaulter list successfully genrated"); }
				else if(data.status = false) { alert("Defaulter list generation failed"); }
				else { alert("Access denied..!"); }
			});
		}
		
	});
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});

jQuery(document).ready(function(){
	
jQuery(document).on("click", ".deleteSemester", function(){
	
		var semId = $(this).data("semid"),
			hitURL = baseURL + "semester/Semester/deletesemester",
			
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Semester Detail ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { semId : semId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Semester Deatails successfully deleted"); }
				else if(data.status = false) { alert("Semester Deatails deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
});



jQuery(document).ready(function(){
	
jQuery(document).on("click", ".deleteRoom", function(){
	
		    
			var roomId = $(this).data("roomid"),
			
			hitURL = baseURL + "room/room/deleteroom",
			
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Room Detail ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { roomId : roomId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Room Details successfully deleted"); }
				else if(data.status = false) { alert("Room Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".deleteSeat", function(){
	
			var seatid = $(this).data("seatid"),
			
			hitURL = baseURL + "seat/seat/deleteseat",
			
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Seat Detail ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { seatid : seatid } 
			}).done(function(data){
				//console.log(data);
				if(data.status == true) { 
				alert("Seat Details successfully deleted"); 
				currentRow.parents('tr').remove();
				}
				else if(data.status == false) { alert("Seat can not be deleted due to Seat is Alloted to student"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
   $(".selectboxit").change(function(){
	//alert($(this).val());
	var status = $(this).val();
	//alert (status);
       //console.log(regno);
		hitURL = baseURL + "report/reports/UpdateSeatChangeStatus", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'status':status},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				
				if (data != "")
				{
					var data = 'Application Approved Sucessfully & Email sent to Applicant'; 
				  $('#feedback').html(data);
				  $('#feedback').show(2500);
				  $('#feedback').fadeOut(2500);
				}
				else
				    {
						
				    var data = 'Application Rejected or Pending Successfully';
					$('#feedback').html(data);
				  $('#feedback').show(2500);
				  $('#feedback').fadeOut(2500);
					}
                // the next thing you want to do 
            }
			
        });
    })
})


$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
   $(".selectinterchange").change(function(){
	//alert($(this).val());
	var status = $(this).val();
	//alert (status);
       //console.log(regno);
		hitURL = baseURL + "report/reports/UpdateSeatInterChangeStatus", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'status':status},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				
				if (data != "")
				{
					var data = 'Application Approved Sucessfully & Email sent to Applicant'; 
				  $('#feedback').html(data);
				  $('#feedback').show(2500);
				  $('#feedback').fadeOut(2500);
				}
				else
				    {
						
				    var data = 'Application Rejected or Pending Successfully';
					$('#feedback').html(data);
				  $('#feedback').show(2500);
				  $('#feedback').fadeOut(2500);
					}
                // the next thing you want to do 
            }
			
        });
    })
})


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteext", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "setting/settings/deleteext",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Ext ?");
		//alert(hitURL);
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Ext successfully deleted"); }
				else if(data.status = false) { alert("Ext deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
	// Delete Web Content
	
	jQuery(document).on("click", ".deleteWeb", function(){
		var webId = $(this).data("webid"),
			hitURL = baseURL + "setting/settings/deleteWeb",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Web Content ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { webId : webId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Web Content successfully deleted"); }
				else if(data.status = false) { alert("Web Content deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
});