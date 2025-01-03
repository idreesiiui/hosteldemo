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
      <img src="<?php echo base_url(); ?>assets/images/Iiui-logo.jpg" style="width:1080px;">
       <!--<a href="#"><b>IIUI Hostel </b><br>Managment System</a>-->
      </div><!-- /.login-logo -->
      <div class="signup-box-body" style="margin-top: -25px;">
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Hostel Registration for Semester<strong> <?php echo $semestercode[0]->SEMCODE?> </strong></h4>
       <form action="<?php echo base_url(); ?>regbox" method="post" role="form">
       <input type="submit" class="btn btn-primary" value="Back" style="float:right"/>
       </form>
        <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php //echo $this->session->flashdata('error'); ?>                    
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
        
        <form role="form" id="signup" action="<?php echo base_url();?>Signup/addNewSignup" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $StudentInfo[0]->REGNO ?>" readonly>
                                        
                                        <input type="hidden" class="form-control required" id="hostelregdate" name="hostelregdate" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value="<?php echo $StudentInfo[0]->STUDENTNAME ?>">   
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6"> 
                                
                                <div class="form-group">
                                        <label for="fname">Father Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" readonly value="<?php echo $StudentInfo[0]->FATHERNAME ?>">
                                    </div>                                
                                </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="snumber">Student Contact No.&nbsp;<span class="grey-11">(e.g 0333xxxxxxx) </span></label>
                                        <input type="number" class="form-control required" id="snumber" name="snumber" maxlength="11" min="11">
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport. <span class="grey-11">(Enter Digits Without dishes) </span></label>
                                        <input type="number" class="form-control required" id="cnic" name="nic" maxlength="13" min="13">
                                      </div>
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="paddress">Permanent Address</label>
                                        <textarea type="text" class="form-control required" id="paddress"  name="paddress" rows="1"></textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city"  name="city" maxlength="128" value=" <?php echo $StudentInfo[0]->CITY  ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control required" id="district"  name="district" maxlength="128">
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
                                <div style="display:none">
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="foccupation">Father Occupation</label>
                                        <input type="text" class="form-control" id="foccupation" name="foccupation" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth.</label>
                                        <input type="text" class="form-control required" id="dob" name="dob" maxlength="128" value="<?php echo $StudentInfo[0]->STUDENTDOB ?>" readonly>
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control required" id="nationality" name="nationality" maxlength="128" value="<?php echo $StudentInfo[0]->NATIONALITY ?>" readonly>   
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="128" readonly value="<?php echo $StudentInfo[0]->DEPARTMENTNAME ?>">
                                    </div>
                                 </div>
                               </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                <div class="form-group">
                                        <label for="role">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value="<?php echo $StudentInfo[0]->FACULTY ?>"> 
                                    </div>    
                                    
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="programe">Programe</label>
                                      <input type="text" class="form-control required" id="programe" name="programe" maxlength="125" readonly value="<?php echo $StudentInfo[0]->PROGRAME ?>"> 
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="admsession">Admission Semester(Session Intake)</label>
                                        <input type="text" class="form-control required" id="admsession" name="admsession" maxlength="25" readonly value="<?php echo $StudentInfo[0]->STADMISSION ?>">
                                    </div>   
                                </div>
                                 <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="programe">CGPA</label>
                                        <input type="number" class="form-control required" id="cgpa" name="cgpa" maxlength="128" readonly value="<?php echo round($StudentInfo[0]->CGPA, 2) ?>">
                                    </div> 
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="gender">Gender</label>
                                      <input readonly type="text" class="form-control required" id="gender" name="gender" value="<?php echo $StudentInfo[0]->GENDER ?>">
                                    </div>  
                                                                       
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emargancyname">Emergency Person Name</label>
                                        <input type="text" class="form-control" id="emargancyname"  name="emargancyname">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emargancynumber">Emergency Person Cell No</label>
                                        <input type="number" class="form-control" id="emargancynumber"  name="emargancynumber">
                                     </div>
                                  </div> 
                                  <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="fcellNo">Father Cell No.</label>
                                        <input type="number" class="form-control" id="fnumber" name="fnumber">
                                    </div>
                                                                   
                                  </div>
                                </div>
                                <div class="row">        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control required" id="password"  name="password" maxlength="10" value="12345">
                                    </div>
                                </div>
                            
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="10" value="12345">
                                       </div>
                                    </div>
                                    </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refname">1st Refrence Person Name</label>
                                        <input type="text" class="form-control" id="refname" name="refname">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refcontact">1st Refrence Person Contact No</label>
                                        <input type="number" class="form-control" id="refcontact" name="refcontact">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refname2">2nd Refrence Person Name</label>
                                        <input type="text" class="form-control" id="refname2" name="refname2" maxlength="120">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refcontact2">2nd Refrence Person Contact No</label>
                                        <input type="number" class="form-control" id="refcontact2" name="refcontact2">
                                    </div>
                                </div>
                                </div>
                            
                       
                        </div><!-- /.box-body -->
    		</div><!-- /.Hidden div -->
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