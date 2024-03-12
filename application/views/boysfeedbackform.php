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
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Hostel Registration for <strong> <?php echo $semestercode[0]->PROGRAME." ".$semestercode[0]->SEMCODE?> </strong></h4>
      
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
                <div class="alert alert-danger alert-dismissable" style="width:850px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="width: 650px; margin-left:0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
               
            </div>
             <?php $this->load->helper('form'); ?>
         <div class="row">
         <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                    </div>
              
       
        <form role="form" id="signup" action="<?php echo base_url();?>Signup/addfeedback" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128" >
                                        
                                        <input type="hidden" class="form-control required" id="hostelregdate" name="hostelregdate" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128">   
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6"> 
                                
                                <div class="form-group">
                                        <label for="fname">Father Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" >
                                    </div>                                
                                </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                                      <label for="snumber">Student Contact No.</label><span class="grey-11">(03xxx) </span>
                                        <input type="number" class="form-control required" id="snumber" name="snumber" maxlength="11" min="11">
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                   <label for="caddress">Current Address</label>
                                      <textarea type="text" class="form-control required" id="caddress"  name="caddress" rows="1"></textarea>
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
                                        <input type="text" class="form-control required" id="city"  name="city" maxlength="128" >
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
                                <div class="row">
                                
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport. <span class="grey-11">(Enter Digits Without dishes) </span></label>
                                        <input type="number" class="form-control required" id="cnic" name="nic" maxlength="13" min="11">
                                      </div>
                                </div>
                                    <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="128" >
                                    </div>
                                 </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                <div class="form-group">
                                        <label for="role">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty" name="faculty" maxlength="128" > 
                                    </div>    
                                    
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="programe">Programe</label>
                                       <select class="form-control required" id="programe" name="programe">
                                       <option value="">Select Programe</option>
                                       <option value="Bachelor">Bachelor</option>
                                       <option value="MS/MPHILL">MS/MPHILL</option>
                                       <option value="PhD">PhD</option>
                                       </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="programe">Degree name</label>
                                        <input type="text" class="form-control required" id="degname" name="degname" maxlength="128">
                                    </div> 
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="gender">Gender</label>
                                      <select class="form-control required" id="gender" name="gender">
                                       <option value="">Select Gender</option>
                                       <option value="Male">Male</option>
                                       <option value="Female">Female</option>
                                       </select>
                                  </div>  
                                    </div>
                                  </div>
                                   <div class="row">
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                   <label for="fbackform">Comments & Suggestion</label>
                                      <textarea type="text" class="form-control required" id="fbackform"  name="fbackform" rows="3"></textarea>
                                  </div>
                                    </div>
                                    </div>
                                  <div style="display:none">
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
  