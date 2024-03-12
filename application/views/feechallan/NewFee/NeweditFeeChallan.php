<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Fee Management
        <small>Edit Fee Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Edit Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="Feestructure" action="<?php echo base_url() ?>feechallan/NewFeechallan/updateFeeinfo" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Current Semester</label>
                                         <input type="text" class="form-control required" id="csem" name="csem" readonly value="<?php echo $editFeeInfo->fee_challan_csem ?>" >
                                         
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Assign Fee Structure</label>
                                         <input type="text" class="form-control required" readonly value="<?php 
						        $feestructureid = $editFeeInfo->new_fee_structure_id;
								$feestatusid = $editFeeInfo->id;
								$CI =& get_instance();
								$CI->load->model('feechallan_model');
								$result = $CI->feechallan_model->GetFeestructureInfo($feestructureid);
								$feetype =  $result->structure_type;
								$feenationality =  $result->nationality;
								$feestructsem =  $result->fee_structure_semester;
								$program =  $result->program;
								
								echo $feestructsem.'-'.$program.'-'.$feenationality;
								
						   ?>" >
                           <input type="hidden" class="form-control required" id="feestructid" name="feestructid" readonly value="<?php echo $feestructureid ?>" >
                           <input type="hidden" class="form-control required" id="id" name="id" readonly value="<?php echo $editFeeInfo->id ?>" >
                                    </div>
                                </div> 
                             </div>
                      
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Issue Date</label>
                                         <input type="date" class="form-control required" id="issuedate"  name="issuedate" maxlength="120" value="<?php echo $editFeeInfo->issuedate ?>" >
                                    </div>
                                </div>   
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Due Date</label>
                                         <input type="date" class="form-control required" id="duedate"  name="duedate" maxlength="120" value="<?php echo $editFeeInfo->duedate ?>" >
                                    </div>
                                </div>       
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Published</label>
                                        <select class="form-control required" id="publish" name="publish" required>
                                            <option value="1" <?php if($editFeeInfo->publish == 1) {echo "selected=selected";} ?>>Yes</option>
                                            <option value="0" <?php if($editFeeInfo->publish == 0) {echo "selected=selected";} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">No. of Months</label>
                                         <input type="number" class="form-control required" id="month" name="month" value="<?php echo $editFeeInfo->month ?>" >
                                         <input type="hidden" class="form-control required" id="id" name="id" value="<?php echo $editFeeInfo->id ?>" >
                                    </div>
                                </div>
                               <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Start Date</label><small style="color:red"> (In case of Allotment Fee Challan)</small>
                                         <input type="date" class="form-control" id="startdate" name="startdate" value="<?php //echo $editFeeInfo->startdate ?>" >
                                         
                                    </div>
                                </div>--> 
                             </div>
                            <!-- <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">End Date</label><small style="color:red"> (In case of Allotment Fee Challan)</small>
                                         <input type="date" class="form-control" id="enddate" name="enddate" value="<?php //echo $editFeeInfo->enddate ?>" >
                                         
                                    </div>
                                </div> 
                             </div>-->
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