<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Card Management
        <small>Update Hostel Student Card Expiry Date</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">View Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
 <form role="form" id="fregform" action="<?php echo base_url();?>card/Cards/UpdatestudentCardExpiryDate" method="post" role="form">
                        <div class="box-body">
                        <div class="row">
                         <div class="col-md-2" style="margin-top:-3em; float:right;margin-right: 20px;">
                                    <div class="form-group">
                    <?php if(!empty($student)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105">
                        <?php }?>
                 
                 
                       </div>
                          </div>
                         </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value=" <?php echo $student[0]->STUDENTNAME;?> " >
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <input readonly type="text" class="form-control required" id="gender" name="gender"  value=" <?php echo $student[0]->GENDER;?> ">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="939-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $student[0]->REGNO;?>" readonly>
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value=" <?php echo $student[0]->FACULTY?>"> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dept">Dpartment</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="128" readonly value=" <?php echo $student[0]->DEPARTNAME;?> ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Programe</label>
                                      <input type="text" class="form-control required" id="programe" name="programe" maxlength="125" readonly value=" <?php echo $student[0]->PROGRAME;?> "> 
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admsession">Card Remarks</label>
                                        <select required class="form-control" name="card_remarks">
                                            <option value="">Select Option</option>
                                            <option value="Allotted" >Allotted</option>
                                            <option value="On Extension">On Extension</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Card Expiry Date</label>
                                        <input required type="date" class="form-control required" id="card_expiry_date" name="card_expiry_date" value="<?php echo $student[0]->card_expiry_date;?>" min="01-01-2010" max="31-12-2050">
                                    </div>
                                </div> 
                                </div>
                               
                                
                                <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="key">Key</label>
                                  <input required type="text" class="form-control" id="key" name="key">                                     
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="semcode">SEMCODE</label>
                                            <input readonly type="text" class="form-control required" id="semcode" name="semcode" maxlength="25" readonly value="<?php echo $student[0]->SEMCODE;?>">
                                        </div>
                                    </div>

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport.</label>
                                        <input type="text" class="form-control required" id="cnic" name="nic" maxlength="15" value=" <?php echo $student[0]->CNIC;?>" readonly>
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="admsession">Hostel Batch</label>
                                            <input type="text" class="form-control required" id="admsession" name="admsession" maxlength="25" readonly value="<?php echo $student[0]->HOSTELBATCH; ?>">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control required" id="nationality" name="nationality" maxlength="128" value=" <?php echo $student[0]->NATIONALITY;?> " readonly>   
                                    </div>
                                </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <input type="text" class="form-control required" id="type" name="type" maxlength="25" readonly value="<?php echo $student[0]->ALLOTTYPE;?>">
                                        </div>
                                    </div>
                                    
                                    
                                 </div>
                              
                              
                       
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Update Card Expiry Date" />
                            <!-- <input onclick="location.href='<?php //echo base_url();?>report/reports/getuserlist/<?php //echo $protitle = $student[0]->PROTITTLE."/"; echo $semestercode = $student[0]->SEMESTERCODE?>'" class="btn btn-default" value="Back" /> -->
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

<script src="<?php echo base_url(); ?>assets/js/report.js" type="text/javascript"></script>