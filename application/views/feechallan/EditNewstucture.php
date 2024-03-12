<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Fee Structure Management
        <small>Edit Security Structure</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit New Fee Structure Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/updateNewFeeStructure" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Nationality</label>
                                       <input type="text" class="form-control required" id="nationality" name="nationality" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->NATIONALITY?>">
                                       <input type="hidden" class="form-control required" id="feeid" name="feeid" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->id?>">
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Programe Level</label>
                                        <input type="text" class="form-control required" id="programelevel" name="programelevel" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->PROTITTLE?>">
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
                                        <label for="feestucture">Fee Structure Semester</label>
                                        <input type="text" class="form-control required" id="feestructure" name="feestructure" maxlength="20" readonly value="<?php echo $editfeeInfo[0]->FEESTRUCSEM?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Fee Type</label>
                                        <select class="form-control required" id="feetype" name="feetype" required>
                                            <option value="<?php echo $editfeeInfo[0]->FEECODE?>"><?php echo $editfeeInfo[0]->FEEDESC?></option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fee Amount</label>
                                        <input type="number" class="form-control required digits" id="feeamount" name="feeamount" maxlength="10" value="<?php echo $editfeeInfo[0]->FEEAMOUNT?>">
                                    </div>
                                </div>       
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelNewfeestructure">Back</a>
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