<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
 <form role="form" id="signup" action="<?php echo base_url();?>report/reports/UpdatestudentStatus" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value=" <?php echo $userInfo[0]->STUDENTNAME;?> " >
                                        <input type="hidden" class="form-control required" id="studentid" name="studentid" value=" <?php echo $userInfo[0]->STUDENTID;?> " >
                                         <input type="hidden" class="form-control required" id="semestercode" name="semestercode" value=" <?php echo $userInfo[0]->SEMESTERCODE;?> " >
                                         <input type="hidden" class="form-control required" id="protitle" name="protitle" value=" <?php echo $userInfo[0]->PROTITTLE;?> " >
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <input readonly type="text" class="form-control required" id="gender" name="gender"  value=" <?php echo $userInfo[0]->GENDER;?> ">
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="939-FBAS/BSSE/S10" name="regno" maxlength="128" value=" <?php echo $userInfo[0]->REGNO;?> " readonly>
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value=" <?php echo $userInfo[0]->FACULTY;?> "> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="128" readonly value=" <?php echo $userInfo[0]->DEPARTMENTNAME;?> ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Programe</label>
                                      <input type="text" class="form-control required" id="programe" name="programe" maxlength="125" readonly value=" <?php echo $userInfo[0]->PROGRAME;?> "> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admsession">Admission Semester(Session Intake)</label>
                                        <input type="text" class="form-control required" id="admsession" name="admsession" maxlength="25" readonly value=" <?php echo $userInfo[0]->STADMISSION;?> ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">CGPA</label>
                                        <input type="text" class="form-control required" id="cgpa" name="cgpa" maxlength="128" readonly value=" <?php echo $userInfo[0]->CGPA;?> ">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Father Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" readonly value=" <?php echo $userInfo[0]->FATHERNAME;?> ">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fcellNo">Father Cell No.</label>
                                        <input type="number" class="form-control" id="fnumber" name="fnumber" value=" <?php echo $userInfo[0]->FATHERNUMBER;?> ">
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="foccupation">Father Occupation</label>
                                        <input type="text" class="form-control" id="foccupation" name="foccupation" maxlength="128" value=" <?php echo $userInfo[0]->FATHEROCCUPATION;?> ">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth.</label>
                                        <input type="text" class="form-control required" id="dob" name="dob" maxlength="128" value=" <?php echo $userInfo[0]->STUDENTDOB;?> " readonly>
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control required" id="nationality" name="nationality" maxlength="128" value=" <?php echo $userInfo[0]->NATIONALITY;?> " readonly>   
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport.</label>
                                        <input type="number" class="form-control required" id="cnic" name="nic" maxlength="15" value=" <?php echo $userInfo[0]->CNIC;?> ">
                                      </div>
                                    
                                    </div>
                                  </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="snumber">Current Address.</label>
                                        <textarea type="text" class="form-control required" id="caddress"  name="caddress" rows="1"><?php echo $userInfo[0]->CADDRESS;?></textarea >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Permanent Address</label>
                                        <textarea type="text" class="form-control required" id="paddress"  name="paddress" rows="1"><?php echo $userInfo[0]->PERMANENT;?></textarea >
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city"  name="city" maxlength="128" value=" <?php echo $userInfo[0]->CITY;?> " readonly>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control required" id="district"  name="district" maxlength="128" value=" <?php echo $userInfo[0]->DISTRICT;?> " readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="privince">Province</label>
                                          <input type="text" class="form-control required" id="province"  name="province" maxlength="128" value=" <?php echo $userInfo[0]->PROVINCE;?> " readonly>
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emargancyname">Emergency Person Name</label>
                                        <input type="text" class="form-control" id="emargancyname"  name="emargancyname" value=" <?php echo $userInfo[0]->EPERSONNAME;?> ">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emargancynumber">Emergency Person Cell No</label>
                                        <input type="number" class="form-control" id="emargancynumber"  name="emargancynumber" value=" <?php echo $userInfo[0]->EPERSONNUMBER;?> " >
                                     </div>
                                  </div> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Student Contact No.</label>
                                        <input type="text" class="form-control required email" id="snumber"  name="snumber" maxlength="128" value=" <?php echo $userInfo[0]->STUDENTNUMBER;?> ">
                                    </div>
                                </div>
                                </div>
                                
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refname">1st Refrence Person Name</label>
                                        <input type="text" class="form-control" id="refname" name="refname" value=" <?php echo $userInfo[0]->REF1NAME;?> " >
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refcontact">1st Refrence Person Contact No</label>
                                        <input type="number" class="form-control" id="refcontact" name="refcontact" value=" <?php echo $userInfo[0]->REF1NUMBER;?> " >
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refname2">2nd Refrence Person Name</label>
                                        <input type="text" class="form-control" id="refname2" name="refname2" maxlength="120" value=" <?php echo $userInfo[0]->REF2NAME;?> ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refcontact2">2nd Refrence Person Contact No</label>
                                        <input type="number" class="form-control" id="refcontact2" name="refcontact2" value=" <?php echo $userInfo[0]->REF2NUMBER;?> ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="privince">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                            <option value=" ">Select Status</option>
                                            <option value="1">Verified</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Cancel</option>
                                            
                                        </select>
                                     </div>
                                  </div>
                                
                                </div>
                            
                       
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input onclick="location.href='<?php echo base_url();?>report/reports/getuserlist/<?php echo $protitle = $userInfo[0]->PROTITTLE."/"; echo $semestercode = $userInfo[0]->SEMESTERCODE?>'" class="btn btn-default" value="Back" />
                        </div>

                    </form>
                </div>
            </div>
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
                <div class="alert alert-success alert-dismissable">
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
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>