<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Information System
        <small>Search</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-decoration:underline">SIS Search</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getallstudentInfo" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-3 control-label">Reg No</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="regno" name="regno">
                  </div>
                  <label style="width:120px" for="text" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-3">
                     <input type="text" class="form-control" id="stname" name="stname" style="text-transform: capitalize;">
                  </div>
                   
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Search"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
              </div><!-- /.box -->
            </div>
            <div class="col-md-3">
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
                    <div class="col-md-2">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>

        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

