<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Fee Challan Installment Management
        <small>Installment Of Fee Challan</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Edit Fee Challan Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="Feestructure" action="<?php echo base_url() ?>feechallan/NewFeechallan/convertChallanInstallment" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Regno </label>
                                         <input readonly type="text" class="form-control required" id="regno" name="regno" readonly value="<?php echo $editFeeInfo->regno ?>" >
                                         
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Assign Fee Structure</label>
                                         <input readonly type="text" class="form-control required" readonly value="<?php  
						        $feestructureid = $editFeeInfo->fee_structure_id;
								$CI =& get_instance();
								$CI->load->model('feechallan_model');
								$result = $CI->feechallan_model->GetFeestructureInfo($feestructureid);
								$feetype =  $result->structure_type;
								$feenationality =  $result->nationality;
								$feestructsem =  $result->fee_structure_semester;
								$program =  $result->program;
								
								echo $feetype.'-'.$feestructsem.'-'.$program.'-'.$feenationality;
								
						   ?>" >
                          
                           <input type="hidden" class="form-control required" id="id" name="id" readonly value="<?php echo $editFeeInfo->id ?>" >
                                    </div>
                                </div> 
                             </div>
                      
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">First Installment Issue Date</label>
                                         <input type="date" class="form-control required" id="firstInstallmentissuedate"  name="firstInstallmentissuedate" maxlength="120">
                                    </div>
                                </div>   
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">First Installment Due Date</label>
                                         <input type="date" class="form-control required" id="firstInstallmentduedate"  name="firstInstallmentduedate" maxlength="120">
                                    </div>
                                </div>       
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Second Installment Issue Date</label>
                                         <input type="date" class="form-control required" id="secondInstallmentissuedate"  name="secondInstallmentissuedate" maxlength="120" >
                                    </div>
                                </div>   
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Second Installment Due Date</label>
                                         <input type="date" class="form-control required" id="secondInstallmentduedate"  name="secondInstallmentduedate" maxlength="120" >
                                    </div>
                                </div>       
                            </div>
                             <div class="row">
                              <!--   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Published First Installment Challan </label>
                                        <select class="form-control required" id="publish" name="publish" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div> -->
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Current Semester</label>
                                         <input readonly type="text" class="form-control required" id="csem" name="csem" readonly value="<?php echo $editFeeInfo->current_semester ?>" >
                                    </div>
                                </div> 
                             </div>
                             <div class="row">
                                 <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Fine Amount</label>
                                         <input readonly type="number" class="form-control required" id="fineamount" name="fineamount" value="<?php echo $editFeeInfo->fineamount ?>" >
                                         
                                        
                                    </div>
                                </div> -->
                             </div>
                             
                       <!--      <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Installments</label><small style="color:red"> Total Amount will be convert in to two installments</small>
                                        <select class="form-control required" id="installment" name="installment" required>                   
                                            <option value="1">First Installment</option>
                                            <option value="2">Second Installment</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/NewFeechallan/newfeechallans">Back</a>
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
<script src="<?php echo base_url(); ?>assets/js/feestucture.js" type="text/javascript"></script>