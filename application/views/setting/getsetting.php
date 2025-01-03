<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       System Setting
        <small>Info</small>
      </h1>
    </section>
    
    <section class="content">        
          <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">All System Settings</h3>
                </div>
                <div class="box-body">
                    <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/settingview">
                        <i class="fa fa-tachometer"></i> Distance Setting  
                    </a>
                        
                    <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/viewExt">
                        <i class="fa fa-building"></i> Ext Setting  
                    </a> 
                        
                    <a class="btn btn-app" href="<?php echo base_url() ?>backup">
                        <i class="fa fa-database"></i> Database Backup  
                    </a>
                        
                    <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/migtoallotreallot" onclick="return confirm('Are you sure you want to Migration of Allotmen?')">
                        <i class="fa fa-exchange"></i> Migration of Allotment  
                    </a>               
                    <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/migrationofReallot" onclick="return confirm('Are you sure you want to Migration of RE-Allotment ?')">
                        <i class="fa fa-exchange"></i> Migration of RE-Allotment  
                    </a> 
                     <a class="btn btn-app" href="<?php echo base_url() ?>credithour">
                        <i class="fa fa-book"></i> Credit Hours Setting  
                    </a>
                     <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/contentUpload">
                        <i class="fa fa-code"></i> Website Content Uplaod  
                    </a>   
                    <a class="btn btn-app" href="<?php echo base_url() ?>studentCraditHour/studentCraditHour">
                        <i class="fa fa-address-card"></i>Student Credit Hours
                    </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>key/key/keylisting">
                        <i class="fa fa-address-card"></i>Update Student Key
                    </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>key/key/studentContactInfo">
                        <i class="fa fa-envelope"></i>Update Student Email
                    </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>feechallan/NewFeechallan/updateChallanAndFee">
                        <i class="fa fa-edit"></i>Update Challan & Fee 
                    </a>
                    <a class="btn btn-app" href="<?php echo base_url('search_std_info'); ?>">
                        <i class="fa fa-edit"></i>Update Student Info 
                    </a> 
                </div>
            </div>
             <div class="col-md-5">
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
    </section>
</div>
