<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Fee Management
        <small>Add Regno Wise Fee Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter New Regno Wise Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="Feestructure" action="<?php echo base_url() ?>feechallan/NewFeechallan/getRegnoFeechallan" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Regno</label>
                                         <input type="text" class="form-control required" id="regno"  name="regno" required >
                                    </div>
                                </div> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feestucture">Fee Structure Semester</label>
                                        <select class="form-control select2 required" id="feestructuresemester" name="feestructuresemester" required>
                                            <option value="">Select Semester</option>
                                            <?php
                                            if(!empty($viewSemInfo))
                                            {
                                                foreach ($viewSemInfo as $rl)
                                                {
                                             ?>
                                                    <option value="<?php echo $rl->id?>"><?php echo $rl->fee_structure_semester.' ('.$rl->structure_type.'-'.$rl->nationality.'-'.$rl->program.')' ?></option>
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
                                        <label for="mobile">Current Semester</label>
                                         <select class="form-control select2 required" id="csem" name="csem" required>
                                          <?php
                                            if(!empty($seminfo))
                                            {
                                                foreach ($seminfo as $rl)
                                                {
                                             ?>
                                                    <option value="<?php echo $rl->SEMCODE?>" <?php if($currentsem->semcode == $rl->SEMCODE) echo 'selected'?>><?php echo $rl->SEMCODE ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div> 
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Published</label>
                                        <select class="form-control required" id="publish" name="publish" required>
                                            <option value="">Select Publish</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Issue Date</label>
                                         <input type="date" class="form-control required" id="issuedate"  name="issuedate" maxlength="120" >
                                    </div>
                                </div>   
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Due Date</label>
                                         <input type="date" class="form-control required" id="duedate"  name="duedate" maxlength="120" >
                                    </div>
                                </div>       
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">No.of Months</label>
                                         <input type="number" class="form-control required" required id="month"  name="month" >
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                             </div>
   
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/NewFeechallan/newfeechallans">Back</a>
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
<script src="<?php echo base_url(); ?>assets/js/feestucture.js" type="text/javascript"></script>
