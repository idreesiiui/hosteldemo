<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Re-Allotment Management
        <small>Edit Seat Re-Allotment</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
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
            <div class="row">
            <!-- left column -->
                 <div class="row">
                 <?php 
                 if(isset($status) && $status == 'close')
				   {
				 ?>
                   <div class="callout callout-danger">
                        <h4>Re-Allotment Close!!</h4>
                
                        <p>For more information! Contact provost Office Hostel IIUI..</p>
                  </div> 
                  <?php 
				   }
                elseif($msg == 1)
				   {
				 ?>
                 <div class="callout callout-success">
                        <h4>Congratulation! Your Application for Hostel Re-Allotment for this semester Submitted Successfully!</h4>
                
                        <p><?php echo 'Confirmation Email is sent on your registered Email Id. Please follow the Email, for more info contact Hostel Admin.'?></p>
                        <div class="row">
           <div class="form-group">
                    <a class="btn btn-primary" style="background-color:#3C8DBC !important" target="_blank" href="<?php echo base_url() ?>reallotment/reAllotment/RenewalForm"><i class="fa fa-print"></i> Print Renewal Form</a>
                </div>
           
        </div>
                  </div>
                  <?php 
				   }
                elseif(!empty($warning))
				   {
				 ?> 
                 <div class="callout callout-warning">
                        <h4>Congratulation! Your Application for Hostel Re-Allotment for this semester Submitted Successfully!</h4>
                
                        <p><?php echo $warning?></p>
                  </div>
                   <?php 
				   }
				 ?>
              </div>  
          </div>    
    </section>
    
</div>

<script src="<?php echo base_url(); ?>assets/js/editallotment.js" type="text/javascript"></script>