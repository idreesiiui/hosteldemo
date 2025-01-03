<div class="content-wrapper">    
    <section class="content-header">
      <h1>
        Successfully submited
        <small>This Fee challan is found with us</small>
      </h1>
    </section>
    <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('warning');
                    if($error)
                    {
                ?>
                <div class="alert alert-warning alert-dismissible" style="font-size:large">
                <i class="icon fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('warning'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <i class="icon fa fa-success"></i>
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
    <section class="content">
        
      <div class="col-md-12">
        <div class="row">
           <div class="form-group">
                    <a class="btn btn-primary" target="_blank" href="<?php echo base_url(); ?>reallotment/reAllotment/RenewalForm"><i class="fa fa-print"></i> Print Renewal Form</a>
                </div>
            <div class="col-xs-12 text-center">
                <img src="<?php echo base_url() ?>assets/images/done.png" alt="Page Not Found Image" />
            </div>
        </div>
      </div>
    </section>
</div>