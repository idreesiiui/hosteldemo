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
    font: 9px Arial,Helvetica,sans-serif;
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
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Male Hostel Seat Change for Semester<strong> <?php echo $semestercode[0]->SEMCODE?> </strong></h4>
       
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
        
        <form role="form" id="signup" action="<?php echo base_url()?>signup/AddMaleSeat" method="post" role="form">
                        <div class="box-body">
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
                                    </div>                                
                                </div>
                                 <div class="col-md-6"> 
                                
                                <div class="form-group">
                                        <label for="fname">Nationality</label>
                                        <input type="text" class="form-control required" id="nationality" name="nationality" readonly value="<?php echo $StudentInfo[0]->NATIONALITY ?>">
                                    </div>                                
                                </div>
                                </div>
                                <div class="box box-primary">
                                <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline; color: #1C6C1B;"><b>Enter the current Hostel & Room</b></h3>
                    </div>
                    </div>
                   
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">Current Hostel <span class="grey-11">(Select Existed Hostel No from Drop Down) </span></label>
                                        <select class="form-control required" id="chostel" name="chostel">
                                            <option value="">Select Current Hostel</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="KHA">KHA</option>
                                            <option value="KHA">KHB</option>
                                            <option value="KHC">KHC</option>
                                            <option value="KHD">KHD</option>
                                            <option value="KHE">KHE</option>
                                            <option value="KHF">KHF</option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                 <div class="form-group">
                                        <label for="room">Room No <span class="grey-11">(Enter Your Existed Room No) </span></label>
                                        <input type="number" class="form-control required" id="croomno"  name="croomno" maxlength="128">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                               <div class="form-group">
                                        <label for="dob">Current Seat <span class="grey-11">(Select Existed Seat Menu) </span></label>
                                        <select class="form-control required" id="cseat" name="cseat">
                                            <option value="">Select Current Seat</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="S">S</option>
                                            <option value="SA">SA</option>
                                            <option value="SB">SB</option>
                                        </select>
                                      </div>
                                </div>
                                </div>
                                 <div class="box box-primary">
                                <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline; color: #1C6C1B;"><b>Transfer To (Enter the deatil of Hostel No & Room No you want to apply for)</b></h3>
                    </div>
                    </div>
                                 
                                <div class="row">
                                 <div class="col-md-3">
                                 <div class="form-group">
                                        <label for="dob">New Hostel <span class="grey-11">(Select New Hostel No Drop Down) </span></label>
                                        <select class="form-control required" id="newhostel" name="newhostel">
                                            <option value="">Select New Hostel</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="KHA">KHA</option>
                                            <option value="KHA">KHB</option>
                                            <option value="KHC">KHC</option>
                                            <option value="KHD">KHD</option>
                                            <option value="KHE">KHE</option>
                                            <option value="KHF">KHF</option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                        <label for="roomno">New Room No</label>
                                        <input type="number" class="form-control required" id="newroomno"  name="newroomno" maxlength="128">
                                    </div>
                                  </div>
                                <div class="col-md-3">
                               <div class="form-group">
                                        <label for="dob">New Seat <span class="grey-11">(Select New Seat from Drop Down) </span></label>
                                        <select class="form-control required" id="newseat" name="newseat">
                                            <option value="">Select New Seat</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="S">S</option>
                                            <option value="SA">SA</option>
                                            <option value="SB">SB</option>
                                        </select>
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