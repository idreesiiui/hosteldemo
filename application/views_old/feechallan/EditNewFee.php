<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Fee Challan Management
        <small>Edit Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit New Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/updateNewFeeChallan" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Regno</label>
                                       <input type="text" class="form-control required" id="regno" name="regno" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->REGNO?>" >
                                       <input type="hidden" class="form-control required" id="feeid" name="feeid" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->ID?>">
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname" name="studentname" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->STUDENTNAME?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Batch Name</label>
                                         <input type="text" class="form-control required" id="batchname" name="batchname" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->BATCHNAME?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feestucture">Fee Challan No</label>
                                        <input type="text" class="form-control required" id="challanno" name="challanno" maxlength="200" readonly value="<?php echo $editfeeInfo[0]->CHALLANNO?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fine Amount</label>
                                        <input type="number" class="form-control required digits" id="fineamount" name="fineamount" maxlength="10" value="<?php echo $editfeeInfo[0]->FINEAMOUNT?>" required>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Total Fee Amount</label>
                                        <input type="text" class="form-control required" id="totalamount" name="totalamount" maxlength="100"  value="<?php echo $totalamount[0]->FEEAMOUNT?>">
                                    </div>
                                </div>      
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            
                                            <option value="1" <?php if($editfeeInfo[0]->STATUS == 1) {echo "selected=selected";} ?> >Published</option>
                                            <option value="0" <?php if($editfeeInfo[0]->STATUS == 0) {echo "selected=selected";} ?> >UnPublished</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fee Amount</label>
                                        <input type="text" class="form-control required digits" id="csem" name="csem" maxlength="10" value="<?php echo $editfeeInfo[0]->CURRENTSEMESTER?>" readonly>
                                    </div>
                                </div>       
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelnewfeechallan">Back</a>
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