<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Search Student to Add Remarks
        <!-- <small>View</small> -->
      </h1>
    </section>
    <section class="content">
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
                <div class="col-md-8">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search student to add remarks</h3>
                        <form action="<?= base_url('submit-remarks'); ?>" class="form-horizontal"  method="post" >
                            <div class="box-body">
                                <div class="form-group">
                                <label style="width:80px" for="text" class="col-sm-2 control-label">Reg No.</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control required" required  name="regno" maxlength="120">
                                </div>
                                <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit"/>
                                <input type="reset" class="btn btn-secondary" value="Reset"/>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

