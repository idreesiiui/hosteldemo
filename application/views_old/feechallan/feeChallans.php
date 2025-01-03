<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Fee Challan Management
        <small>Search Hostel Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Hostel Fee Challan Details</h3>
                        <!-- <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php //echo base_url(); ?>feechallan/Feechallan/addnorFeeschallan">Add New</a> -->
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/ViewHostelFeeChallans" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="role">Fees Semester</label>
                                        <select class="form-control required" id="semester" name="semester" required>
                                            <!-- <option value="">Select Fees Semester</option> -->
                                            <?php
                                            if(!empty($viewSemInfo))
                                            {
                                                foreach ($viewSemInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->current_semester ?>"><?php echo $rl->current_semester ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label for="role">Select Nationality</label>
                                        <select class="form-control" id="nationality" name="nationality">
                                            <!-- <option value="">Select Nationality:</option> -->
                                            <?php
                                            if(!empty($nationality))
                                            {
                                                foreach ($nationality as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->nationality ?>"><?php echo $rl->nationality ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label for="role">Fee Type</label>
                                        <select class="form-control" id="feetype" name="feetype">
                                            <!-- <option value="">Select Fee Type</option> -->
                                            <?php
                                            if(!empty($feeType))
                                            {
                                                foreach ($feeType as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->feetype; ?>">
                                                        <?php echo $rl->feetype; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label for="role">Is Publish</label>
                                        <select class="form-control" id="ispublished" name="ispublished">
                                            <!-- <option value="">Select Option</option> -->
                                            <?php
                                            if(!empty($isPublish))
                                            {
                                                foreach ($isPublish as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo ($rl->publish == '1')?'Published':'UnPublished'; ?>"><?php echo ($rl->publish == '1')?'Published':'UnPublished'; ?></option>
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
