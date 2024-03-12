<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       New Fee Structure Management
        <small>Add Structure</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter New Fee Structure Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="Feestructure" action="<?php echo base_url() ?>feechallan/NewFeechallan/storeFeeStructure" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Structure Type</label>
                                        <select class="form-control required" id="structuretype" name="structuretype" required>
                                            <option value="">Select Struture Type</option>
                                           <?php
                                             if(!empty($viewTypeInfo))
                                            {
                                                foreach ($viewTypeInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->name ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
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
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Program</label>
                                        <select class="form-control required" id="program" name="program" required>
                                            <option value="">Select Program</option>
                                             <?php
                                            if(!empty($viewProgInfo))
                                            {
                                                foreach ($viewProgInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->PROTITTLE ?>"><?php echo $rl->PROTITTLE ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feestucture">Fee Structure Semester</label>
                                        <select class="form-control required" id="feestructuresemester" name="feestructuresemester" required>
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
                                        <label for="gender">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="">Select Status</option>
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
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/NewFeechallan/feestructureListing">Back</a>
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