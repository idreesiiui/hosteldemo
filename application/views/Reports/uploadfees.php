<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Upload Challan Form
        <small>Add / Edit Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="hostel" action="<?php echo base_url() ?>report/reports/UploadFeeslip" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" name="regno" readonly maxlength="10" value="<?php echo $Allotment[0]->REGNO ?>">
                                        <input type="hidden" class="form-control required" id="reallot" name="reallot" readonly maxlength="10" value="<?php echo $Allotment[0]->ID ?>">
                                        <input type="hidden" class="form-control required" id="gender" name="gender" readonly maxlength="10" value="<?php echo $Allotment[0]->GENDER ?>">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hosteldesc">Student Name</label>
                                        <input type="text" class="form-control required" id="studname"  name="studname" readonly maxlength="128" value="<?php echo $Allotment[0]->STUDENTNAME ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomcap">Faculty</label>
                                        <input type="text" class="form-control required" id="faculty"  name="faculty" readonly maxlength="10" value="<?php echo $Allotment[0]->FACULTY ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatcap">Department</label>
                                        <input type="text" class="form-control required" id="dept" name="dept" maxlength="40" readonly value="<?php echo $Allotment[0]->DEPARTNAME ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floors">Fee Amount</label>
                                        <input type="number" class="form-control required" id="fee" name="fee" maxlength="10" value="<?php if(!empty($feestatus)) echo $feestatus[0]->FEEAMOUNT; else echo '';?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Challan No.</label>
                                        <input type="number" class="form-control required" required id="vno" name="vno" maxlength="12" value="<?php if(!empty($feestatus)) echo $feestatus[0]->RECEIPTNO; else echo '';?>">
                                    </div>
                                </div> 
                                <div id="uploadfeeslip"> 
                                 <div class="col-md-6">
                                    <!--<div class="form-group">
                                        <label for="alloteddate">Upload Fee Slip<span style="font-size:10px; color:red"> Max size 3Mb Dimension 4000 width x 2000 height</span></label><br>
                 <img width="400" height="200" src="<?php //if(empty($feestatus)) { echo base_url() ?>/assets/dist/img/cnic.png <?php //} else echo base_url().'uploads/feeslip/'.$feestatus[0]->FEEPIC;?>" id="vcnic1" src="#" alt="your image" class="img-thumb">
                     
                  <div class="col-md-10" >
                  
                    <input type="file"  onchange="cnicreadURL(this);" id="feeslip" name="feeslip" class="form-control required">
                 <span><?php //if(!empty($feestatus[0]->FEEPIC)) echo '<i style="color:green;font-size:20px;font-family:calibri ;">You have uploded challan succesfully. If want to change challan info than upload otherwise go to apply reallotment section.</i>';?></span>
                  </div>
                                    </div> --><br><br><br>
                                    <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>  
                            </div>
                           
                        <!-- /.box-body -->
    
                        
                </div>
            </div>
            <div class="col-md-10">
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
<script src="<?php echo base_url(); ?>assets/js/signup.js" type="text/javascript"></script>