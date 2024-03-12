<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fee Structure Management
        <small>Add / Edit Structure</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Fee Structure Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/addReAllotmentStructure" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Nationality</label>
                                        <select class="form-control required" id="nationality" name="nationality" required>
                                            <option value="">Select Nationality</option>
                                            <option value="Pakistani">Pakistani</option>
                                            <option value="Foreigner">Foreigner</option>
                                        </select>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Programe Level</label>
                                        <select class="form-control required" id="programelevel" name="programelevel" required>
                                            <option value="">Select Programe Level</option>
                                            <option value="BS">BS</option>
                                            <option value="MS">MS</option>
                                            <option value="PHD">PHD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Batch Name</label><span style="font-size:12px; color:grey;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;(Ctrl+click to select more than one item)</span>
                                        <select class="form-control required" id="batchname" name="batchname[]" multiple required>
                                            <!--<option value="">Select Batches</option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feestucture">Fee Structure Semester</label>
                                        <select class="form-control required" id="feestructure" name="feestructure" required>
                                            <option value="">Select Semestere</option>
                                            <?php
                                            if(!empty($viewSemInfo))
                                            {
                                                foreach ($viewSemInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->SEMCODE ?>"><?php echo $rl->SEMCODE ?></option>
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
                                        <label for="role">Fee Type</label>
                                        <select class="form-control required" id="feetype" name="feetype" required>
                                            <option value="">Select fee Type</option>
                                            <?php
                                            if(!empty($viewfeeInfo))
                                            {
                                                foreach ($viewfeeInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->FEECODE ?>"><?php echo $rl->FEEDESC ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fee Amount</label>
                                        <input type="number" class="form-control required digits" id="feeamount" name="feeamount" maxlength="10" required>
                                    </div>
                                </div>       
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelduesfeestructure">Back</a>
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