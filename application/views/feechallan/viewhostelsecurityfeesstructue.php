<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Security Fee Structure Management
        <small>Search Hostel Security Structure</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Hostel Fee Security Structure Details</h3>
                        <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/Feesecurity">Add New</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/ViewSecurityFeeStructure" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Security Fees Structures</label>
                                        <select class="form-control required" id="feesem" name="feesem" required>
                                            <option value="">Select Security Fees Structure</option>
                                            <?php
                                            if(!empty($viewFeeInfo))
                                            {
                                                foreach ($viewFeeInfo as $rl)
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
                                        <label for="role">Fees Type</label>
                                        <select class="form-control" id="feedesc" name="feedesc">
                                            <option value="">Select Fee Type</option>
                                            <?php
                                            if(!empty($viewfeeTypeInfo))
                                            {
                                                foreach ($viewfeeTypeInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->FEECODE ?>"><?php echo $rl->FEEDESC ?></option>
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
