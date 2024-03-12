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
	
	var addUserForm = $("#signup");
	
	var validator = addUserForm.validate({
		
		rules:{
			name :{ required : true },
			gender : { required : true, selected : true },
			regno : { required : true }, 
			dept : {required : true, selected : true},
			faculty : {required : true, selected : true},
			programe : {required : true, selected : true},
			fname : {required : true},
			foccupation : {required : true},
			dob : {required : true},
			nationality : { required : true, selected : true },
			cnic : { required : true},
			snumber : { required : true},
			district : { required : true},
			province : { required : true},
			city : { required : true},
			paddress : { required : true},
			emargancyname : { required : true},
			emargancynumber : { required : true, digits : true },
			fnumber : { required : true, digits : true },
			fnumber : { required : true },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			refname : { required : true },
			refcontact : { required : true, digits : true },
			refname2 : { required : true },
			refcontact2 : { required : true, digits : true },
			email : { required : true}
		},
		messages:{
			name :{ required : "This field is required" },
			gender : { required : "This field is required", selected : "Please select atleast one option" },
			regno : { required : "This field is required" },
			dept : {required : "This field is required", selected : "Please select atleast one option"},
			faculty : {required : "This field is required", selected : "Please select atleast one option" },
			programe : {required : "This field is required", selected : "Please select atleast one option" },
			fname : {required : "This field is required" },
			foccupation : {required : "This field is required" },
			nationality: {required : "This field is required", selected : "Please select atleast one option" },
			dob: {required : "This field is required" },
			cnic: {required : "This field is required" },
			snumber: {required : "This field is required" },
			paddress: {required : "This field is required" },
			province: {required : "This field is required" },
			city: {required : "This field is required" },
			emargancyname: {required : "This field is required" },
			emargancynumber: { required : "This field is required", digits : "Please enter numbers only" },
			district: {required : "This field is required" },
			fnumber : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required" },	
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			refname : { required : "This field is required" },
			refcontact : { required : "This field is required", digits : "Please enter numbers only" },
			refname2 : { required : "This field is required" },
			refcontact2 : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required", email : "Please enter valid email address" }		
		}
	});
});

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#faculty").change(function() {
		var faculty = $('#faculty').val();
       // alert (faculty);
           
          $.ajax({
            type:'POST',
            url:'signup/getdepartment',
            data:{'faculty':faculty},
            success:function(data){
				//$('#dept').html(data);
				console.log(data);
				// $('#dept').html('<option value="">-- Select Type --</option>');

				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].dept_id + " '>" + jsonData1[i].deptname + " </option>";
                    }
					$('#depts').html('<option value=""> Select Department</option>');
                    $("#depts").append(appenddata1);
           
				
                // the next thing you want to do 
            }
        });
      
    })
})

$(document).ready(function() {
	
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
    $("#regno").change(function() {
		var regno = $('#regno').val();
       //alert (regno);
	   
	   
	   $.ajax({
            type:'POST',
            url:'signup/getstudentdetails',
            data:{'regno':regno},
            success:function(data){
				//$('#dept').html(data);
				console.log(data);
				//alert(data);
				// $('#dept').html('<option value="">-- Select Type --</option>');
					if(data != "[]"){
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                       // appenddata1 += "<option value = '" + jsonData1[i].dept_id + " '>" + jsonData1[i].deptname + " </option>";             
					  var name = jsonData1[i].STUDENTNAME;
					  var gender = jsonData1[i].gender;
					  var programe = jsonData1[i].programe;
					  var semestername = jsonData1[i].semestername;
					  var cgpa = jsonData1[i].cgpa;
					  var fathername = jsonData1[i].fathername;
					  var fathernumber = jsonData1[i].fathernumber;
					  var fatheroccupation = jsonData1[i].fatheroccupation;
					  var studentdob       = jsonData1[i].studentdob;
					  var nationality      = jsonData1[i].nationality;
					  var cnic             = jsonData1[i].cnic;
					  var studentnumber	   = jsonData1[i].studentnumber;
					  var permanent		   = jsonData1[i].permanent;
					 
					  
                    
					}
					//$('#dept').html('<option value=""> Select Department</option>');
                    $("#name").val(name);
					$("#gender").val(gender);
					$("#programe").val(programe);
					$("#admsession").val(semestername);
					$("#cgpa").val(cgpa);
					$("#fname").val(fathername);
					$("#fnumber").val(fathernumber);
					$("#foccupation").val(fatheroccupation);
					$("#dob").val(studentdob);
					$("#nationality").val(nationality);
					$("#fnumber").val(fathernumber);
					$("#foccupation").val(fatheroccupation);
					$("#dob").val(studentdob);
					$("#nationality").val(nationality);
					$("#cnic").val(cnic);
					$("#snumber").val(studentnumber);
					$("#paddress").val(permanent);
					

					}
					else 
						alert('No Record Exist in database.');
           
				
                // the next thing you want to do 
            }
        });
	   
	   
	   
	   
	});
});