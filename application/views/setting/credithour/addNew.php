<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Credit Hours Management
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
                        <h3 class="box-title">Enter Credit Hours Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="credits" action="<?php echo base_url() ?>addNewCreditInfo" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">BS Credits (Pakistani)</label>
                                        <select class="form-control required" id="bscredit" name="bscredit">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MA/MSC Credits (Pakistani)</label>
                                        <select class="form-control required" id="macredit" name="macredit">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">MBA(1.5) Credits (Pakistani)</label>
                                        <select class="form-control required" id="mba1credit" name="mba1credit">
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MBA(3.5) Credits (Pakistani)</label>
                                        <select class="form-control required" id="mba3credit" name="mba3credit">
                                           <option value="0" >0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MS Credits (Pakistani)</label>
                                        <select class="form-control required" id="mscredit" name="mscredit">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">PHD Credits (Pakistani)</label>
                                        <select class="form-control required" id="phdcredit" name="phdcredit">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">BS Credits (Foreigner)</label>
                                        <select class="form-control required" id="bscreditfor" name="bscreditfor">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MA/MSC Credits (Foreigner)</label>
                                        <select class="form-control required" id="macreditfor" name="macreditfor">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                             <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">MBA(1.5) Credits (Foreigner)</label>
                                        <select class="form-control required" id="mba1creditfor" name="mba1creditfor">
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                           
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MBA(3.5) Credits (Foreigner)</label>
                                        <select class="form-control required" id="mba3creditfor" name="mba3creditfor">
                                           <option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">MS Credits (Foreigner)</label>
                                        <select class="form-control required" id="mscreditfor" name="mscreditfor">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">PHD Credits (Foreigner)</label>
                                        <select class="form-control required" id="phdcreditfor" name="phdcreditfor">
                                            <option value="">Select Credits</option>
                                           	<option value="0">0</option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">Type</label>
                                         <select class="form-control required" id="type" name="type">
                                            <option value="">Select type</option>
                                           	<option value="Allotment">Allotment</option>
       										<option value="ReAllotment">ReAllotment</option>
                                        </select>
                                        <input type="hidden" class="form-control required" id="semcode" name="semcode" readonly required maxlength="12" value="<?php echo strtoupper($semestercode[0]->SEMCODE)?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">Status</label>
                                        <select class="form-control required" id="status" name="status">
                                            <option value="">Select Status</option>
                                           	<option value="1">Enable</option>
       										<option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">Semester:</label>
                                         <input type="text"  class="form-control required" id="semcode" name="semcode" readonly required maxlength="12" value="<?php echo strtoupper($semestercode[0]->SEMCODE)?>">
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
<script src="<?php echo base_url(); ?>assets/js/credits.js" type="text/javascript"></script>