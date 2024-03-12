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
    $("#programelevel").change(function() {
		var programelevel = $('#programelevel').val();
		var nationality = $('#nationality').val();
	    if(nationality == '')
		   {
			   alert('Oops! Select Nationality First');
						location.reload();
						exit();
		   }
		hitURL = baseURL + "feechallan/Feechallan/Getprograme", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'programelevel':programelevel, 'nationality':nationality},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! No Records in AllotReallot. Migrate record First to proceed');
						location.reload();
						exit();
				}
				else if(data != "[]")
				 {
					 var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
						
                        appenddata1 += "<option value = '" + jsonData1[i].BATCHNAME.replace(/'/g, "") + " '>" + jsonData1[i].BATCHNAME + " </option>";
                    }
					$('#batchname').html('<option value=""></option>');
					
					$("#batchname").empty();
                    
					$("#batchname").append(appenddata1);

				 }
		   				
                // the next thing you want to do 
            
		    }	
        });
    });
});


$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#assignfeestruc").change(function() {
		var programechallan = $('#programechallan').val();
		var nationality = $('#nationality').val();
		var assignfeestruc = $('#assignfeestruc').val();
		if(nationality == '' || programechallan == '')
		  {
			  alert('Select Nationality and Programe level First to proceed');
						location.reload();
						exit();
		  }
	    // console.log(regno);
		hitURL = baseURL + "feechallan/Feechallan/GetUniqueFeecode", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'programechallan':programechallan,'nationality':nationality, 'assignfeestruc':assignfeestruc},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! No Fee Strucuture Define against values');
						location.reload();
						exit();
				}
				else if(data != "[]")
				 {
					 var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].FEECODE + " '>" + jsonData1[i].FEEDESC + ' ' + jsonData1[i].FEEAMOUNT + " </option>";
                    }
					$('#feedesc').html('<option value=""></option>');
					
					$("#feedesc").empty();
                    
					$("#feedesc").append(appenddata1);

				 }
		   				
                // the next thing you want to do 
            
		    }	
        });
    });
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#sassignfeestruc").change(function() {
		var programechallan = $('#programechallan').val();
		var nationality = $('#nationality').val();
		var assignfeestruc = $('#sassignfeestruc').val();
		if(nationality == '' || programechallan == '')
		  {
			  alert('Select Nationality and Programe level First to proceed');
						location.reload();
						exit();
		  }
	    // console.log(regno);
		hitURL = baseURL + "feechallan/Feechallan/GetUniqueFeecodeSecurity", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'programechallan':programechallan,'nationality':nationality, 'assignfeestruc':assignfeestruc},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! No Security Fee Strucuture Define against values');
						location.reload();
						exit();
				}
				else if(data != "[]")
				 {
					 var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].FEECODE + " '>" + jsonData1[i].FEEDESC + ' ' + jsonData1[i].FEEAMOUNT + " </option>";
                    }
					$('#feedesc').html('<option value=""></option>');
					
					$("#feedesc").empty();
                    
					$("#feedesc").append(appenddata1);

				 }
		   				
                // the next thing you want to do 
            
		    }	
        });
    });
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#newassignfeestruc").change(function() {
		var programechallan = $('#programechallan').val();
		var nationality = $('#nationality').val();
		var assignfeestruc = $('#newassignfeestruc').val();
		if(nationality == '' || programechallan == '')
		  {
			  alert('Select Nationality and Programe level First to proceed');
						location.reload();
						exit();
		  }
	    // console.log(regno);
		hitURL = baseURL + "feechallan/Feechallan/GetUniqueFeecodeNewStud", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'programechallan':programechallan,'nationality':nationality, 'assignfeestruc':assignfeestruc},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! No Security Fee Strucuture Define against values');
						location.reload();
						exit();
				}
				else if(data != "[]")
				 {
					 var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].FEECODE + " '>" + jsonData1[i].FEEDESC + ' ' + jsonData1[i].FEEAMOUNT + " </option>";
                    }
					$('#feedesc').html('<option value=""></option>');
					
					$("#feedesc").empty();
                    
					$("#feedesc").append(appenddata1);

				 }
		   				
                // the next thing you want to do 
            
		    }	
        });
    });
});


$(document).ready(function() {
    var tamount = parseInt($('#totalamount').val());

    $("#fineamount").keyup(function() {
		var $fa = $('#fineamount').val();
		if($fa != '')
		{
			var fineamount = parseInt($('#fineamount').val());
			totalamount = tamount + fineamount;
			$('#totalamount').val(totalamount);
		}
		else if($fa == '')
		{
			$('#totalamount').val(tamount);
		}
		
    });
});
$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#semesterfor").change(function() {
		var sprogramelevel = $('#sprogramelevel').val();
		var snationality = $('#snationality').val();
		var semcode = $('#semesterfor').val();
	    if(snationality == '' || semcode == '')
		   {
			   alert('Oops! Select Nationality and Programe First to proceed');
						location.reload();
						exit();
		   }
		hitURL = baseURL + "feechallan/Feechallan/Getsecurityprograme", 
		$.ajax({
            type:'POST',
			url : hitURL,
            data:{'sprogramelevel':sprogramelevel, 'snationality':snationality, 'semcode':semcode},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				//alert(data);
				if(data == "[]")
				{
					alert('Oops! No Student Verified from New application. Verfied record First to proceed');
						location.reload();
						exit();
				}
				else if(data != "[]")
				 {
					 var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 +="<option value ='"+jsonData1[i].BATCHNAME.replace('\u0000','')+"'>" + jsonData1[i].BATCHNAME + " </option>";
                    }
					$('#batchname').html('<option value=""></option>');
                    
					$("#batchname").empty();
					$("#batchname").append(appenddata1);

				 }
		   				
                // the next thing you want to do 
            
		    }	
        });
    });
});


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