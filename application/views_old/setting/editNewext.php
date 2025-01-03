<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Ext Management
        <small>Add / Edit Ext</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Ext Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>setting/settings/UpdateExt" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="gender">Student Type</label>
                                        <select class="form-control required" id="studenttype" name="studenttype">
                                        <?php
										if($ext[0]->studenttype != '' && isset($ext[0]->studenttype))
										{
										?>
                                            <option value="" <?php if($ext[0]->studenttype == '' && isset($ext[0]->studenttype)) {echo "selected=selected";} ?>>Select Student Type</option>
                                            <option value="Pakistani" <?php if($ext[0]->studenttype == 'Pakistani') {echo "selected=selected";} ?>> <?php echo 'Pakistani' ?> </option>
                                            <option value="Foreigner" <?php if($ext[0]->studenttype == 'Foreigner') {echo "selected=selected";} ?>> Foreigner</option>
                                       <?php 
										}
										else{
										?>
                                        <option value="">Select Student Type</option>
                                        <option value="Pakistani">Pakistani</option>
                                        <option value="Foreigner">Foreigner</option>
                                         <?php 
										}
										?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Degree Tittle</label>
                                         <select class="form-control required" id="programe" name="programe">
                                         <?php
										if($ext[0]->degreetittle != '' && isset($ext[0]->degreetittle))
										{
										?>
                                            <option value="<?php if($ext[0]->degreetittle != '' && isset($ext[0]->degreetittle)) echo $ext[0]->degreetittle;else {echo 'Select Degree programe';}  ?>" <?php if($ext[0]->degreetittle == '' && isset($ext[0]->degreetittle)) {echo "selected=selected";} ?>><?php if($ext[0]->degreetittle != '' && isset($ext[0]->degreetittle)) echo $ext[0]->degreetittle;else {echo 'Select Degree programe';}  ?></option>
                                        <?php 
										}
										else{
										?>
                                        <option value="">Select Degree programe</option>
                                         <?php 
										}
										?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noofyear">No. Of Year Programe</label>
                                        <input type="number" class="form-control required" id="noofyear"  name="noofyear" readonly value="<?php if(isset($ext[0]->noofyear))echo $ext[0]->noofyear; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                            <input type="text" class="form-control required" id="gender" name="gender" value="<?php echo $gender; ?>" readonly>
                            <input type="hidden" class="form-control required" id="extid" name="extid" value="<?php if(isset($ext[0]->id))echo $ext[0]->id; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">1st Ext</label>
                                        <input type="text" class="form-control required" id="1stext" name="1stext" style="text-transform:capitalize;" value="<?php if(isset($ext[0]->firstext))echo $ext[0]->firstext; ?>">
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">2nd Ext</label>
                                          <input type="text" class="form-control required" id="2ndext" name="2ndext" style="text-transform:capitalize;" value="<?php if(isset($ext[0]->secondext))echo $ext[0]->secondext; ?>">
                                    </div>
                                </div>      
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
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
<script src="<?php echo base_url(); ?>assets/js/addExt.js" type="text/javascript"></script>