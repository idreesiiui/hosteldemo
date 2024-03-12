<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Contact Info Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>key/key/insert_student_constact_info" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="student_name">Name</label>
                                        <input readonly type="text" class="form-control required" id="student_name" name="student_name" maxlength="128" value="<?php echo $from_tbl_hstd[0]->STUDENTNAME; ?>">
                                    </div>                                    
                                </div>
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="student_email">Student Email</label>
                                        <?php if(!empty($from_tbl_hstd[0]->STUDENTEMAIL)){ ?>
                                            <input readonly type="text" class="form-control required" id="student_email" name="student_email" value="<?php echo $from_tbl_hstd[0]->STUDENTEMAIL; ?>">
                                        <?php }else{ ?>
                                            <input required type="text" class="form-control " id="student_email" name="student_email" value="<?php echo $from_tbl_hstd[0]->STUDENTEMAIL; ?>">
                                        <?php } ?>
                                        
                                  </div>
                               </div>
                            </div>
                         <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                         
                                        <input readonly type="text" class="form-control required" id="gender" name="gender" maxlength="128" style="text-transform:uppercase" value="<?php echo ($from_tbl_hstd[0]->GENDER == 'M') ? 'Male' : 'Female'; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                       <div class="form-group">
                                        <label for="regno">Registration No</label>
                                        <input readonly type="text" class="form-control required" id="regno" name="regno" maxlength="128" style="text-transform:uppercase" value="<?php echo $from_tbl_hstd[0]->REGNO; ?>">
                                        
                                       </div>
                                    </div>
                            </div>
                                 <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="cnic">CNIC/Passport</label>
                                        <?php if(!empty($from_tbl_hstd[0]->CNIC)) { ?>
                                            <input readonly type="text" class="form-control required" id="cnic" name="cnic" maxlength="128" value="<?php echo $from_tbl_hstd[0]->CNIC; ?>">
                                        <?php } else { ?>

                                        <input required type="text" class="form-control required" id="cnic" name="cnic" maxlength="128" value="<?php echo $from_tbl_hstd[0]->CNIC; ?>">

                                        <?php } ?>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>