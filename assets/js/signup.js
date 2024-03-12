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
			degtitle : {required : true, selected : true},
			fname : {required : true},
			fnumber : { required : true, minlength: 11, digits : true},
			dob : {required : true},
			nationality : { required : true, selected : true },
			cnic : { required : true, maxlength: 13, digits : false},
			snumber : { required : true, minlength: 11, digits : true },
			district : { required : true},
			province : { required : true},
			city : { required : true},
			paddress : { required : true},
			emargancyname : { required : true},
			emargancynumber : { required : true, minlength: 11, digits : true },
			emargancycnic : { required : true, maxlength: 13, digits : true },
			password : { required : true, maxlength: 12, minlength: 6 },
			cpassword : {required : true, equalTo: "#password", maxlength: 12, minlength: 6},
			refname : { required : true },
			refcontact : { required : true, minlength: 11, digits : true },
			refname2 : { required : true },
			refcontact2 : { required : true, minlength: 11, digits : true },
			email : { required : true},
			cemail : {required : true, equalTo: "#email"},
		},
		messages:{
			name :{ required : "This field is required" },
			degtitle : { required : "This field is required", selected : "Please select atleast one option" },
			regno : { required : "This field is required" },
			dept : {required : "This field is required", selected : "Please select atleast one option"},
			faculty : {required : "This field is required", selected : "Please select atleast one option" },
			programe : {required : "This field is required", selected : "Please select atleast one option" },
			fname : {required : "This field is required" },
			nationality: {required : "This field is required", selected : "Please select atleast one option" },
			dob: {required : "This field is required" },
			cnic: {required : "This field is required" },
			snumber: {required : "This field is required" },
			paddress: {required : "This field is required" },
			province: {required : "This field is required" },
			city: {required : "This field is required" },
			emargancyname: {required : "This field is required" },
			emargancynumber: { required : "This field is required", digits : "Please enter numbers only" },
			emargancycnic: { required : "This field is required", digits : "Please enter numbers only" },
			district: {required : "This field is required" },	
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			//refname : { required : "This field is required" },
			//refcontact : { required : "This field is required", digits : "Please enter numbers only" },
			//refname2 : { required : "This field is required" },
			//refcontact2 : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required", email : "Please enter valid email address" },
			cemail : {required : "This field is required", equalTo: "Please enter same email as in email field" },	
		},
		errorElement: "em",
		errorPlacement:errorPlacement,
		highlight:highlight,
		unhighlight:unhighlight
	});
});

	function errorPlacement( error, element ) {
		// Add the `invalid-feedback` class to the error element
		error.addClass( "invalid-feedback" );

		if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.next( "label" ) );
		} else {
			error.insertAfter( element );
		}
	}
	function highlight( element, errorClass, validClass ) {
		$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
	}	
	function unhighlight(element, errorClass, validClass) {
		$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
	}
$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#faculty").change(function() {
		var faculty = $('#faculty').val();
       //alert (faculty);
        //hitURL = baseURL + "Signup/getdepartment", 
		$.ajax({
            type:'POST',
			url : "http://usis.iiu.edu.pk:7900/femalereg/getdepartment",
            data:{'faculty':faculty},
			async: false,
            success:function(data){
				//$('#dept').html(data);
				//console.log(data);
				// $('#dept').html('<option value="">-- Select Type --</option>');

				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                        appenddata1 += "<option value = '" + jsonData1[i].DNAME + " '>" + jsonData1[i].DNAME + " </option>";
                    }
					$('#dept').html('<option value=""> Select Department</option>');
                    $("#dept").append(appenddata1);
           
				
                // the next thing you want to do 
            }
        });
      
    })
})

/*$(document).ready(function() {
	
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
/*
<!-- Start Jquery post function -->

$(document).ready(function() {
    //$("#dept").children('option:gt(0)').hide();
    $("#regno").change(function() {
		var regno = $('#regno').val();
       //alert (regno);
	   var str= regno.match(/\d{2}$/);
	   var semester = $('#hostelregdate').val();
	   var semcode = semester.substr(semester.length - 3);
	  //alert(str);
	  //alert(semcode);
	  if (str <= semcode)
	  {
	   $.ajax({
            type:'POST',
            url:'signup/getstudentdetails',
            data:{'regno':regno},
            success:function(data){
				//$('#dept').html(data);
				console.log(data);
				//alert(data);
				// $('#dept').html('<option value="">-- Select Type --</option>');
				if (data != "[]"){
				var appenddata1 = "";
                    
                    var jsonData1 = JSON.parse(data);
                    for (var i = 0; i < jsonData1.length; i++) {
                       // appenddata1 += "<option value = '" + jsonData1[i].dept_id + " '>" + jsonData1[i].deptname + " </option>";             
					  var name = jsonData1[i].STUDENTNAME;
					  var gender = jsonData1[i].GENDER;
					  var programe = jsonData1[i].PROGRAME;
					 // var admissiondate  = jsonData1[i].ADMISSIONDATE;
					  var cgpa = jsonData1[i].CGPA;
					  var province = jsonData1[i].PROVINCE;
					  var fathername = jsonData1[i].FATHERNAME;
					  var fathernumber = jsonData1[i].FATHERNUMBER;
					  var fatheroccupation = jsonData1[i].FATHEROCCUPATION;
					  var studentdob       = jsonData1[i].STUDENTDOB;
					  var nationality      = jsonData1[i].NATIONALITY;
					  var cnic             = jsonData1[i].CNIC;
					  var cgpa             = jsonData1[i].CGPA;
					  var studentnumber	   = jsonData1[i].STUDENTNUMBER;
					  var permanent		   = jsonData1[i].PERMANENT;
					  var faculty    	   = jsonData1[i].FACULTY;
					  var dept  		   = jsonData1[i].DEPARTMENTNAME;
					  var email    	       = jsonData1[i].STUDENTEMAIL;
					  var district		   = jsonData1[i].DISTRICT;
					  var city    	 	   = jsonData1[i].CITY;
					  var admsession       = jsonData1[i].STADMISSION;
					  
                    }
					
					//$('#dept').html('<option value=""> Select Department</option>');
                    $("#name").val(name);
					$("#gender").val(gender);
					$("#programe").val(programe);
					//$("#admissiondate").val(admissiondate);
					$("#admsession").val(admsession);
					var cgpa = parseFloat(cgpa);
					var gpa = cgpa.toFixed(2);
					$("#cgpa").val(gpa);
					$("#fname").val(fathername);
					$("#fnumber").val(fathernumber);
					$("#foccupation").val(fatheroccupation);
					$("#dob").val(studentdob);
					$("#nationality").val(nationality);
					$("#foccupation").val(fatheroccupation);
					$("#nationality").val(nationality);
					$("#cnic").val(cnic);
					$("#province").val(province);
					$("#snumber").val(studentnumber);
					$("#paddress").val(permanent);
					$("#faculty").val(faculty);
					$("#city").val(city);
					$("#district").val(district);
					$("#dept").val(dept);
					$("#email").val(email);
				}
				else
				    alert('No records exist against this Registration Number.');


           
				
                // the next thing you want to do 
            }
        });
	   
	   
	   }
	   else alert('you are not eligible in this Semester for Hostel.');
	});
});
<!-- End jquery post function -->
*/

$(document).ready(function(){
   $('#cemail').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});

$(document).ready(function() {
$("#cgpa").change(function() {
    var num = parseFloat($("#cgpa").val());
    var new_num = $("#cgpa").val(num.toFixed(2));
});
});

function redirect()
{
	window.location = "http://localhost/hostelserver";
}
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
function cnicreadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#vcnic1')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function cnic2readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#vcnic2')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function cnic3readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#vcnic3')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function cnic4readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#vcnic4')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
$('#cnicno1').keydown(function(){
 
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
 
 $('#cnicno2').keydown(function(){
 
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
 
 