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
		
    </style>
  </head>
  <body class="login-page">
    <div class="signup-box" style="margin-top: 0px;">
      <div class="login-logo">
      <img src="<?php echo base_url(); ?>assets/images/Iiui-logo.jpg" style="width:1080px;">
       <!--<a href="#"><b>IIUI Hostel </b><br>Managment System</a>-->
      </div><!-- /.login-logo -->
      <div class="signup-box-body" style="margin-top: -25px;">
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Hostel Seat Re-Allotment Form </strong></h4>
       
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
        
        <form role="form" id="freallotadmin" action="<?php echo base_url();?>freallot/AddSignup" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128">
      
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly >   
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                    <label for="gender">Father Name</label>
                                      <input type="text" class="form-control required" id="fathername" name="fathername" readonly>
                                    </div> 
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="128" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Programe</label>
                                      <input type="text" class="form-control required" id="programe" name="programe" maxlength="125"readonly> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">CGPA</label>
                                        <input type="number" class="form-control required" id="cgpa" name="cgpa" maxlength="128" readonly value="<?php echo round($Studentacad[0]->CGPA, 2) ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control required" id="gender"  name="gender" maxlength="128" readonly>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Semester</label>
                                        <input type="text" class="form-control required" id="semcode" name="semcode" maxlength="128" style="text-transform:uppercase" >
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
                                        <label for="password">Password</label><span style="font-size:10px; color:green; font-weight:bold">&nbsp;(Enter new password for Hostel Students Web Portal) </span>

                                        <input type="password" class="form-control required" id="password"  name="password" maxlength="10">
                                    </div>
                                </div>
                            
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="10">
                                       </div>
                                    </div>
                                    </div>
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                           
                    <a class="btn btn-default" href="<?php echo base_url()?>login" style=" float:right">Back</a>
                        

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
    <script src="<?php echo base_url(); ?>assets/js/reallotment.js" type="text/javascript"></script>