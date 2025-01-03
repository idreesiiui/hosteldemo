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
      
       <h4 class="login-box-msg" style="text-decoration:underline;">Girls Hostel Registration for Semester<strong> <?php echo $semestercode[0]->SEMCODE?> </strong></h4>
       <h5 style="text-align: center;font-style: oblique; font-weight:bold; color:#00a65a;">Application for New Enroll Students (Without RegNo#)</h5>
       
               <div class="col-md-4">
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
       
        
        <form role="form" id="signup" action="<?php echo base_url();?>femalereg/addNewreg" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="formno" name="formno" maxlength="128" value="<?php if(empty($StudentInfo[0]->ID)) echo 1;else echo $StudentInfo[0]->ID.rand(10,1000) ?>" readonly>
                                        
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
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                    <label for="gender">Gender</label>
                                      <input type="text" class="form-control required" id="gender" name="gender" value="Female" readonly>
                                    </div> 
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="faculty">Faculty</label>
                                        <select class="form-control required" id="faculty" name="faculty">
                                            <option value="">Select Faculty</option>
                                            <?php if (!empty($faculty)) 
											{ 
												foreach ($faculty as $fac)
											{
											?>
                                            <option value="<?php echo $fac->FACULTY_ID?>"><?php echo $fac->FNAME?></option>
                                         <?php 
										    }
										
										 } 
										 ?>
                                         </select>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <select class="form-control required" id="dept" name="dept">
                                            <option value="">Select Department</option>
                                         </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       <label for="smecode">Programe</label>
                                         <select class="form-control required" id="programe" name="programe">
                                            <option value="">Select Programe</option>
                                            <option value="BS">Bachelor</option>
											<option value="MS">MS/MPHILL</option>
                                            <option value="PHD">PHD</option>
                                        </select>
                                         </div>
                                </div>
                                        <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="smecode">Degree title</label>
                                        <input type="text" class="form-control required" id="degtitle" name="degtitle" maxlength="35">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admsession">Admission Semester(Session Intake)</label>
                                        <input type="text" class="form-control required" id="admsession" name="admsession" maxlength="25" value="<?php echo $semestercode[0]->SEMCODE?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">CGPA</label>
                                        <input type="number" class="form-control required" id="cgpa" name="cgpa" maxlength="128" value="0" readonly>
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
                                        <label for="fcellNo">Father Cell No.</label>
                                        <input type="number" class="form-control required" id="fnumber" name="fnumber" maxlength="11">
                                    </div>
                                    
                                  </div>
                                </div>
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
                                        <input type="date" class="form-control required" id="dob" name="dob" maxlength="128" >
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                   <select class="form-control required" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <?php if (!empty($country)) 
											{ 
												foreach ($country as $count)
											{
											?>
                                            <option value="<?php echo $count->name?>"><?php echo $count->name?></option>
                                         <?php 
										    }
										
										 } 
										 ?>
                                         </select>

                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">CNIC/Form-B/Passport.</label>
                                        <input type="number" class="form-control required" id="cnic" name="cnic" maxlength="15">
                                      </div>
                                    
                                    </div>
                                  </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="snumber">Student Contact No.</label>
                                        <input type="number" class="form-control required" id="snumber" name="snumber" maxlength="30">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Address</label>
                                        <textarea type="text" class="form-control required" id="paddress"  name="paddress" rows="1"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city"  name="city" maxlength="128">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control required" id="district"  name="district" maxlength="128">
                                    </div>
                                </div>
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
                                        <label for="emargancyname">Emergency Person Name</label>
                                        <input type="text" class="form-control" id="emargancyname"  name="emargancyname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emargancynumber">Emergency Person Cell No</label>
                                        <input type="number" class="form-control" id="emargancynumber"  name="emargancynumber">
                                     </div>
                                  </div> 
                                </div>                        
 
                            <!-- <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Visitor CNIC Holder Person Name</label>
                                         <input type="text" class="form-control required" id="cnicperson1"  name="cnicperson1" maxlength="220" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Visitor CNIC No#</label>
                                         <input type="text" class="form-control required" id="cnicno1"  name="cnicno1" maxlength="15" placeholder="xxxxx-xxxxxxx-x">
                                    </div>
                                </div>
                              </div>-->
                        <!-- div info CNIC HIDE END--> 
                             </div>
                              <!--<div class="row">
                              <div id="uploadcnic"> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alloteddate">Upload Visitor CNIC (Front side)</label><br>
                 <img src="<?php //echo base_url() ?>/assets/dist/img/cnic.png" id="vcnic1" src="#" alt="your image" class="img-thumb">
                     
                  <div class="col-md-10" >
                  
                    <input type="file"  onchange="cnicreadURL(this);" id="vcnic1" name="vcnic1" class="form-control required">
                 
                  </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alloteddate">Upload Visitor CNIC (Back side)</label><br>
                 <img src="<?php //echo base_url() ?>/assets/dist/img/cnic.png" id="vcnic2" src="#" alt="your image" class="img-thumb">
                     
                  <div class="col-md-10" >
                  
                    <input type="file"  onchange="cnic2readURL(this);" id="vcnic2" name="vcnic2" class="form-control required" >
                 
                  </div>
                                    </div>
                                </div>
                             </div>
                       <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Visitor CNIC Holder Person Name2</label>
                                         <input type="text" class="form-control required" id="cnicperson2"  name="cnicperson2" maxlength="220" >
                                    </div>
                                </div>
								<br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Visitor CNIC No#2</label>
                                         <input type="text" class="form-control required" id="cnicno2"  name="cnicno2" maxlength="15" placeholder="xxxxx-xxxxxxx-x">
                                    </div>
                                </div>
                              </div>
                             </div>
                              <div class="row">
                              <div id="uploadcnic">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alloteddate">Upload Visitor CNIC2 (Front side)</label><br>
                 <img src="<?php //echo base_url() ?>/assets/dist/img/cnic.png" id="vcnic3" src="#" alt="your image" class="img-thumb">
                     
                  <div class="col-md-10" >
                  
                    <input type="file"  onchange="cnic3readURL(this);" id="vcnic3" name="vcnic3" class="form-control required">
                 
                  </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alloteddate">Upload Visitor CNIC2 (Back side)</label>
                 <img src="<?php //echo base_url() ?>/assets/dist/img/cnic.png" id="vcnic4" src="#" alt="your image" class="img-thumb">
                     
                  <div class="col-md-10" >
                  
                    <input type="file"  onchange="cnic4readURL(this);" id="vcnic4" name="vcnic4" class="form-control required" >
                 
                  </div>
                                    </div>
                                </div>
                             </div>
<!-- >
                       
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