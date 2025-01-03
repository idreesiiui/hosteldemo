<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Application for Hostel Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/signup.js" type="text/javascript"></script>
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
		/* Blink for Webkit and others
(Chrome, Safari, Firefox, IE, ...)
*/

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
}

    </style>

</head>
<body>

<div class="container">
 
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" id="close">&times;</button>-->
       
          <h4 class="modal-title"><img src="<?php echo base_url() ?>/assets/images/Iiui-logo1.jpg" style="width:100px; height:100px"> Online Application for Male Hostel Registration</h4>
          
          <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable" style="width: 480px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php }else{ ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="width: 485px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php }} ?>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
       
       <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
      
        </div> <!--action="<?php //echo base_url();?>regbox/getregdetails"-->
        <div class="modal-body" style="padding:0">
        
        	
                </div>
        	<div class="modal-footer">
             <div class="col-md-5" text-left">
              <div class="form-group">
                                       <a href="<?php echo base_url() ?>regbox/malecampus"><button type="button" class="btn btn-block btn-primary">New Seat Application</button></a>
                  </div>
                 </div>
         
                  <div class="col-md-6" text-right">
                 <div class="form-group">
<a href="<?php echo base_url() ?>regbox/Mseatchange"><button type="button" class="btn btn-block btn-primary">Seat Change Application</button></a>
                 </div>
                    </div>
                   
              </div>
      </div>
      
    </div>
  </div>
  
</div>

<script>
$(document).ready(function(){
   // $("#myBtn").click(function(){
        //$("#myModal").modal();
		$('#myModal').modal({backdrop: 'static', keyboard: false})
   // });
});
</script>

<script>
$(document).ready(function(){
   $("#close").click(function(){
        //$("#myModal").modal();
		window.location = "http://localhost/hostelserver";
    });
});
</script>
<script>
/*$(document).ready(function(){
$( "form" ).submit(function( event ) {

  //$("#submit").click(function(){
        //$("#myModal").modal();
		//$("#regn").change(function() {
		var regno = $('#regn').val();
      // alert (regno);
	   var str= regno.match(/\d{2}$/);
	   var semester = $('#semesterdate').val();
	   var semcode = semester.substr(semester.length - 2);
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
					  var regno = jsonData1[i].REGNO;
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
					$("#regno").val(regno);
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
					
					window.location = "http://localhost/hostelserver/signup?regno=" + regno;
				}
				else
				     var msg = 'No Record Exist against this registration number.';
		            $('#msg').html(msg);


           
				
                // the next thing you want to do 
            }
        });
	   
	   
	   }
	   else var msg = 'Invalid Registration Number or you are not Eligible to apply.';
		  $('#msg').html(msg);
	  
	  /* --- End of logic code ----   */ 
   });
});
   </script>
   <script src="<?php echo base_url(); ?>assets/js/regbox.js" type="text/javascript"></script>
</body>
</html>

          
          
         
          
          