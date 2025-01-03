<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fee Structure Management
        <small>Select Fee Structure</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Select Fee Structure Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/addReAllotmentStructure" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary" style="background-color:#3C8DBC" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelduesfeestructure">Hostel Dues Fee Structure</a>
                                    </div>
                                </div>
                               <div class="col-md-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary" style="background-color:#3C8DBC" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelfeesecurity">Security Fee Structure</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary" style="background-color:#3C8DBC" href="<?php echo base_url(); ?>allotment/Allotment/ViewDefaulter">Hostel Interchange Fee Structure</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary" style="background-color:#3C8DBC" href="<?php echo base_url(); ?>allotment/Allotment/ViewDefaulter">Hostel Attachment Fee Structure</a>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                               <div class="col-md-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary" style="background-color:#3C8DBC" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelNewfeestructure">New Student Hostel Fee Structure</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
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
