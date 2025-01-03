<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Security Fee Challan Management
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
                        <h3 class="box-title">Enter Security Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/SubmitSecurityFeeChallan" method="post" role="form">
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
                                        <select class="form-control required" id="programechallan" name="programechallan" required>
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
                                        <label for="mobile">Assign Fee Structure</label>
                                        <select class="form-control required" id="sassignfeestruc" name="assignfeestruc" required>
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
                                        <label for="feestucture">Semester for</label>
                                        <select class="form-control required" id="semesterfor" name="semesterfor" required>
                                            <option value="">Select Current Semester</option>
                                            <?php
                                            if(!empty($CSemInfo))
                                            {
                                                foreach ($CSemInfo as $rl)
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
                                        <label for="role">Fee Challan Type</label>
                                       <input type="text" class="form-control required" id="feetype" name="feetype" value="<?php echo 'HOSTEL SECURITY' ?>" readonly required>
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
                                        <label for="gender">Fee Description</label>
                                        <select class="form-control required" id="feedesc" name="feedesc[]" multiple required>
                                 
                                        </select>
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
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelsecurityfeechallan">Back</a>
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