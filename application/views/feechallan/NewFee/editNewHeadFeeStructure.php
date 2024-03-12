<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Fee Structure Head Management
        <small>Edit Fee Structure Head</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Edit Fee Structure Head Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="feestructurehead" action="<?php echo base_url() ?>feechallan/NewFeechallan/updateFeeStructureHead" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Head Name</label>
                                        <input type="text" class="form-control required digits" id="headname" name="headname" maxlength="100" value="<?php echo $FeeStructureHeadInfo->head_name ?>" required>
                                         <input type="hidden" class="form-control required digits" id="id" name="id" maxlength="100" value="<?php echo $FeeStructureHeadInfo->id ?>" required>
                                         <input type="hidden" class="form-control required digits" id="fee_structure_semester" name="fee_structure_semester" maxlength="100" value="<?php echo $FeeStructureHeadInfo->new_fee_structure_id ?>" required>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Head Code</label>
                                        <input type="number" class="form-control required digits" id="headcode" name="headcode" maxlength="10" value="<?php echo $FeeStructureHeadInfo->head_code ?>" readonly required>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Amount</label><small style="color:red"> (In case of Hostel User Charges must be month wise)</small>
                                        <input type="number" class="form-control required digits" id="amount" name="amount" maxlength="10" value="<?php echo $FeeStructureHeadInfo->amount ?>" required>
                                    </div>
                                </div> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="1" <?php if($FeeStructureHeadInfo->status == 1) {echo "selected=selected";} ?>>Enable</option>
                                            <option value="0" <?php if($FeeStructureHeadInfo->status == 0) {echo "selected=selected";} ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>       
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/NewFeechallan/feestructureHeadListing">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
               <div class="alert alert-success alert-dismissable">
                    Head name = 'Hostel User Charges'<br>
                    Head Code = '100'<br>
                    Head name = 'Extension Fee'<br>
                    Head code = '107'
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