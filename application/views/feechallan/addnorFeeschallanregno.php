<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fee Challan Management
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
                        <h3 class="box-title">Enter Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/SubmitFeeChallanregno" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Student Regno</label>
                                       <input type="text" class="form-control required" id="regno" name="regno" required>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feestucture">Current Semester</label>
                                        <select class="form-control required" id="csemester" name="csemester" required>
                                            <option value="">Select Current Semester</option>
                                            <?php
                                            if(!empty($semcode))
                                            {
                                                foreach ($semcode as $rl)
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
                                        <label for="mobile">Assign Fee Structure</label>
                                        <select class="form-control required" id="assignfeestruc" name="assignfeestruc" required>
                                            <option value="">Select fee stucture</option>
                                            <?php
                                            if(!empty($feestrucInfo))
                                            {
                                                foreach ($feestrucInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->FEESTRUCSEM ?>"><?php echo $rl->FEESTRUCSEM ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Challan Due Date</label>
                                        <input type="date" class="form-control required" id="duedate" name="duedate" required>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Hostel Processing Fee(Amount)</label>
                                       <input type="number" class="form-control required" id="processingfee" name="processingfee" value="50" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Hostel User Charges(Amount)</label>
                                       <input type="number" class="form-control required" id="usercharges" name="usercharges" required>
                                    </div>
                                </div>        
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Fee Challan Type</label>
                                       <input type="text" class="form-control required" id="feetype" name="feetype" value="<?php echo 'HOSTEL FEE' ?>" readonly required>
                                    </div>
                                </div>      
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelduesfeechallan">Back</a>
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