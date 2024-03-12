<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>IIUI Hostel Managment System | User System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
		.grey-11 {
    font: 11px Arial,Helvetica,sans-serif;
    color: #999;
    text-decoration: none;
}
    </style>
  </head>
  <body class="login-page">
    <div class="signup-box" style="margin-top: 0px;">
      <div class="login-logo">
      <img src="<?php echo base_url(); ?>assets/images/Iiui-logo.jpg" style="width:100%;">
       <!--<a href="#"><b>IIUI Hostel </b><br>Managment System</a>-->
      </div><!-- /.login-logo -->
      <div class="signup-box-body" style="margin-top: -25px;">
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Hostel Registration for Semester<strong> <?php echo $semestercode[0]->SEMESTEROPENREG?> </strong></h4>
       
        <div class="col-md-6">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="width: 450px; margin-left:300px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>        
            </div>
              
        <form role="form" id="signup" action="<?php echo base_url()?>signup/addNewMaleSignup" method="post" role="form">
                        <div class="box-body">
                        <div class="row">
                                 <div class="col-md-2" style="margin-top:-3em; float:right;">
                                       <div class="form-group">
                            <?php if(!empty($studentpic) && isset($studentpic)){ 
                            $blobimg = $studentpic[0]->STUDPIC;
                            ?>
                          <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                         
                         <?php } else {?>
                                <img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="" height="105">
                                <?php }?>
                         
                         
                                        </div>
                                   </div>
                               </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $StudentInfo[0]->REGNO ?>" readonly>
                                        <input type="hidden" class="form-control required" id="protittle" name="protittle" maxlength="128" value="<?php echo $StudentInfo[0]->PROTITTLE ?>" readonly>
                                        
                                        <input type="hidden" class="form-control required" id="semcode" name="semcode" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value="<?php echo $StudentInfo[0]->STUDENTNAME ?>">
                                        <input type="hidden" class="form-control required" id="dept" name="dept" maxlength="128" readonly value="<?php echo $StudentInfo[0]->DEPARTMENTNAME ?>">   
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6"> 
                                
                                <div class="form-group">
                                        <label for="fname">Father Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" readonly value="<?php echo $StudentInfo[0]->FATHERNAME ?>">
                                         <input type="hidden" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value="<?php echo $StudentInfo[0]->FACULTY ?>">
                                         <input type="hidden" class="form-control required" id="programe" name="programe" maxlength="128" readonly value="<?php echo $StudentInfo[0]->PROGRAME ?>">
                                         <input type="hidden" class="form-control required" id="batchname" name="batchname" maxlength="128" readonly value="<?php echo $StudentInfo[0]->BATCHNAME ?>">
                                    </div>                                
                                </div>
                                 <div class="col-md-6">
                                <div class="form-group">
                                        <label for="snumber">CGPA</label>
                                        <input type="text" class="form-control required" id="cgpa" name="cgpa" maxlength="12" value="<?php echo number_format($StudentInfo[0]->CGPA, 1, '.', '') ?>" readonly>
                                    </div>
                                    
                                </div>
                                </div>
                                 <div class="row">
                                <div class="col-md-6"> 
                                
                                <div class="form-group">
                                        <label for="fname">Nationality</label>
                                        <input type="text" class="form-control required" id="nationality" name="nationality" readonly value="<?php echo $StudentInfo[0]->NATIONALITY ?>">
                                        <input type="hidden" class="form-control required" id="ptittle" name="ptittle" readonly value="<?php echo $StudentInfo[0]->PROTITTLE ?>">
                                    </div>                                
                                </div>
                                 <div class="col-md-6">
                                  <div class="form-group">
                                        <label for="snumber">Student Contact No.&nbsp;<span class="grey-11">(e.g 0333-xxxxxxx) </span></label>
                                        <input type="text" class="form-control required" id="snumber" name="snumber" maxlength="12" value="<?php echo $StudentInfo[0]->STUDENTNUMBER ?>">
                                        <input type="hidden" class="form-control required" id="gender" name="gender" value="Male">
                                    </div>               
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport/Refugee. <span class="grey-11">(Enter Digits Without dishes) </span></label>
                                        <input type="text" class="form-control required" id="cnic" name="cnic" maxlength="15" value="<?php echo $StudentInfo[0]->CNIC ?>">
                                         <input type="hidden" class="form-control required" id="dob" name="dob" maxlength="128" readonly value="<?php echo $StudentInfo[0]->STUDENTDOB ?>">
                                      </div>
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="paddress">Address</label>
                                        <textarea type="text" class="form-control required" id="address"  name="address" rows="1"><?php echo $StudentInfo[0]->PREADD ?></textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city"  name="city" maxlength="128" value=" <?php echo $StudentInfo[0]->CITY  ?>">
                                        <input type="hidden" class="form-control required" id="status"  name="status" maxlength="128" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control required" id="district"  name="district" maxlength="128" value=" <?php echo $StudentInfo[0]->DISTRICT?>">
                                         <input type="hidden" class="form-control required" id="stadmission"  name="stadmission" maxlength="128" value=" <?php echo $StudentInfo[0]->STADMISSION?>">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="privince">Province</label>
                                         <select class="form-control required" id="province" name="province">
                                            <option value="">Select Province</option>
                                            <option value="Azad ">Azad Kashmir</option>
                                            <option value="Balochistan">Balochistan</option>
                                            <option value="Federally Administered Tribal Areas">Federally Administered Tribal Areas</option>
                                            <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="Islamabad Capital Territory">Islamabad Capital Territory</option>
                                            <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                            <option value="North-West Frontier">North-West Frontier</option>
                                            <option value="Northern Areas">Northern Areas</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Sindh">Sindh</option>
                                        </select>
                                     </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email"  name="email" maxlength="128">
                                    </div>
                                  </div>
                                </div>
                                
                            
                       
                        </div><!-- /.box-body -->
    		
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>

        <!--<br><a href="#">Forgot Password</a> <a style="float:right;" href="<?php //echo base_url() ?>signup">Sigup New Student</a>--><br>
        
        
        
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


  </body>
</html>

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/signup.js" type="text/javascript"></script>