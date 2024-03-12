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
            <div class="col-md-11">
            
								<?php
                                    $this->load->helper('form');
                                    $error = $this->session->flashdata('error');
                                    if($error || $err_message)
                                    {
                                ?>
                                <div class="alert alert-danger alert-dismissable instruction">
                                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                                    <?php echo $this->session->flashdata('error'); ?> 
                                    <?php echo $err_message; ?>                   
                                </div>
                                <?php } ?>
                                <?php  
                                    $success = $this->session->flashdata('success');
                                    if($success)
                                    {
                                ?>
                                <div class="alert alert-success alert-dismissable" style="width: 450px; margin-left:300px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php } ?>        
                     </div> 
              </div>     
    </section>
    
</div>
