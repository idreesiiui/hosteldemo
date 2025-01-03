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
                    
                    <form role="form" id="Feestructure" action="<?php echo base_url() ?>feechallan/NewFeechallan/updateFeeinfobyRegno" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Regno </label>
                                         <input type="text" class="form-control required" id="regno" name="regno" readonly value="<?php echo $editFeeInfo->regno ?>" >
                                         
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Assign Fee Structure</label>
                                         <input type="text" class="form-control required" readonly value="<?php  
						        $feestructureid = $editFeeInfo->fee_structure_id;
								$CI =& get_instance();
								$CI->load->model('feechallan_model');
								$result = $CI->feechallan_model->GetFeestructureInfo($feestructureid);
								$feetype =  $result->structure_type;
								$feenationality =  $result->nationality;
								$feestructsem =  $result->fee_structure_semester;
								$program =  $result->program;
								
								echo $feetype.'-'.$feestructsem.'-'.$program.'-'.$feenationality;
								
						   ?>" >
                          
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
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fine Amount</label>
                                         <input type="number" class="form-control required" id="fineamount" name="fineamount" value="<?php echo $editFeeInfo->fineamount ?>" >
                                         
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Current Semester</label>
                                         <input type="text" class="form-control required" id="csem" name="csem" readonly value="<?php echo $editFeeInfo->current_semester ?>" >
                                    </div>
                                </div> 
                             </div>
                             <?php if($feetype == 'ReAllotment'){?>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Extension</label>
                                        <select class="form-control required" id="extension" name="extension" required>
                                            <option value="0" <?php if($editFeeInfo->extension == 0) {echo "selected=selected";} ?>>No Extension Fee</option>
                                            <option value="1st Extension Fee" <?php if($editFeeInfo->extension == '1st Extension Fee') {echo "selected=selected";} ?>>1st Extension Fee</option>
                                            <option value="2nd Extension Fee" <?php if($editFeeInfo->extension == '2nd Extension Fee') {echo "selected=selected";} ?>>2nd Extension Fee</option>
                                            <option value="3rd Extension Fee" <?php if($editFeeInfo->extension == '3rd Extension Fee') {echo "selected=selected";} ?>>3rd Extension Fee</option>
                                            <option value="4th Extension Fee" <?php if($editFeeInfo->extension == '4th Extension Fee') {echo "selected=selected";} ?>>4th Extension Fee</option>
                                            <option value="5th Extension Fee" <?php if($editFeeInfo->extension == '5th Extension Fee') {echo "selected=selected";} ?>>5th Extension Fee</option>
                                            <option value="6th Extension Fee" <?php if($editFeeInfo->extension == '6th Extension Fee') {echo "selected=selected";} ?>>6th Extension Fee</option>
                                            <option value="7th Extension Fee" <?php if($editFeeInfo->extension == '7th Extension Fee') {echo "selected=selected";} ?>>7th Extension Fee</option>
                                            <option value="8th Extension Fee" <?php if($editFeeInfo->extension == '8th Extension Fee') {echo "selected=selected";} ?>>8th Extension Fee</option>
                                            <option value="9th Extension Fee" <?php if($editFeeInfo->extension == '9th Extension Fee') {echo "selected=selected";} ?>>9th Extension Fee</option>
                                            <option value="10th Extension Fee" <?php if($editFeeInfo->extension == '10th Extension Fee') {echo "selected=selected";} ?>>10th Extension Fee</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Modify Amount</label><small style="color:red"> Amount will be subtracted from hostel User Charges</small>
                                         <input type="number" class="form-control required" id="modify" name="modify" required value="<?php echo $editFeeInfo->modify ?>" >
                                    </div>
                                </div>
                             </div> 
                             <?php } ?>  
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