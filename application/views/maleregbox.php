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
         <?php
		   if(!empty($semestercode) && isset($semestercode))
		        {		          
					$startdate = $semestercode[0]->STARTREGDATE;
					$starttime = $semestercode[0]->STARTREGTIME;
					$enddate = $semestercode[0]->CLOSEREGDATE;
					$endtime = $semestercode[0]->ENDREGTIME;
					$startDay = date('l', strtotime($startdate));
					$regstartdate = date("jS F, Y", strtotime($startdate));
					$regstarttime  = date("g:i a", strtotime($starttime));
					$endday = date('l', strtotime($enddate));
					$regenddate = date("jS F, Y", strtotime($enddate));
					$regendtime  = date("g:i a", strtotime($endtime));

		        }
		 ?>
          <h3 class="modal-title"><img src="<?php echo base_url() ?>/assets/images/Iiui-logo1.jpg" style="width:100px; height:100px"> Online Application for Hostel Registration</h3>
          <h5> Registration for <?php echo "<b>(".$semestercode[0]->PROGRAME.") ".$semestercode[0]->SEMESTEROPENREG."</b>".' and before'; ?></h5>
          <div style="display:none"><span style="color:grey; font-size:12px; margin-left:-190px">(First Come Fisrt Serve Basis)</span></div>
          <h3 style="color: #388F3A;" class="blink" align="center">Registration Open</h3>
          <p style="color:red">Registration open on <?php echo $startDay.','.$regstartdate.' at '.$regstarttime.' and will be closed on '.$endday.' '.$regenddate.' at '.$regendtime?>. For more Information <a href="https://www.iiu.edu.pk/wp-content/uploads/downloads/hostel/male/2019/april/waiting-ms-level-240419.jpg" target="_blank">Click here</a> </p>
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
        <div class="modal-body">
         <form role="form" action="<?php echo base_url() ?>regbox/getmalestudentdetails" method="post" id="regbox">
          <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group" style="width:350px">
                                    <span style="color:red; font-size:13px" id="msg"></span>
                                        <label for="regno">Student Reg No#.</label>
                                        <input type="text" required class="form-control required" id="regno" placeholder="123-FBAS/MSSE/S10" name="regno" maxlength="128" style="width:60%">
                                      <input type="hidden" name="programe" value="<?php echo $semestercode[0]->PROGRAME?>">
                                        <input type="hidden" class="form-control required" id="semesterdate" value="<?php echo $semestercode[0]->SEMCODE?>" name="regn" maxlength="128">
                                    </div>
                                    
                                </div>
<div style="color: darkgrey;width: 200px;height: 100px;float: right;">e.g 123-FBAS/MSSE/F09 <br/>(Reg No# Case Sensitive)<br/>
Please Enter Registrarion number as per Student Card</div>
        </div>
        <div class="box-footer">
         
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        
                        </div>
        </form>
        <div class="modal-footer">
    <!--    <a href="<?php //echo base_url() ?>signup/getstudentform">Feedback and suggestion form</a> -->
          <!--<button type="button" class="btn btn-default" id="close" >Close</button>-->
         <!-- data-dismiss="modal"-->
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

          
          
         
          
          