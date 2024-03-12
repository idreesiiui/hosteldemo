<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Management
        <small>Verify student</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->

             
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">View Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
 <form role="form" id="fregform" action="<?php echo base_url();?>reallotment/Reallotment/UpdateKeyAndReallotmentHistory" method="post" role="form">
                        <div class="box-body">
                        <div class="row">
                         <div class="col-md-2" style="margin-top:-3em; float:right;margin-right: 20px;">
                                    <div class="form-group">
                    <?php if(!empty($userInfo)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105">
                        <?php }?>
                 
                 
                       </div>
                          </div>
                         </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value="<?php echo $userInfo[0]->STUDENTNAME;?>" >
                                    </div>                                    
                                </div>
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="939-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $userInfo[0]->REGNO;?>" readonly>
                                    </div>
                                    
                                </div>
                                 
                                </div>
                                
                                
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostel_batch">Hostel Batch</label>
                                        <input type="text" class="form-control required" id="hostel_batch" name="hostel_batch" maxlength="25" readonly value="<?php echo $userInfo[0]->HOSTELBATCH;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="programe">Key</label>
                                        <input type="text" class="form-control required" id="key" name="key">
                                    </div>
                                </div>
                                </div>
                              
                                <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control required" id="nationality" name="nationality" maxlength="128" value="<?php echo $userInfo[0]->NATIONALITY;?>" readonly>   
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="allotment_type">Allotment Type</label>
                                        <input type="text" class="form-control required" id="allotment_type" name="allotment_type" maxlength="128" value="<?php echo $userInfo[0]->ALLOTTYPE;?>" readonly>
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="row">

                                     <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="snumber">Current Semester</label>
                                        <input type="text" class="form-control required" id="semcode"  name="semcode" rows="1" readonly
                                            value="<?php echo $userInfo[0]->SEMCODE; ?>">
                                    </div>
                                    
                                </div>
                               
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="dob">CNIC/Passport.</label>
                                        <input type="text" class="form-control required" id="cnic" name="nic" maxlength="15" value="<?php echo $userInfo[0]->CNIC;?>" readonly>
                                      </div>
                                    
                                    </div>
                                  </div>                              
                             
                                <div class="row">
                                 <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="fee_amount">Fee Amount</label>
                                        <input type="text" readonly class="form-control" id="fee_amount"  name="fee_amount" value="<?php if(isset($userInfo[0]->FEEAMOUNT)) echo  $userInfo[0]->FEEAMOUNT;?>" >
                                    </div>  
                                  </div> 
                                  <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="receipno">RECEIPT NO</label>
                                        <input type="text" readonly class="form-control" id="receipno"  name="receipno" value="<?php if(isset($userInfo[0]->RECEIPTNO)) echo $userInfo[0]->RECEIPTNO;?>"  >
                                     </div> 
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="alloted_date">ALLOTED DATE</label>
                                        <input type="text" readonly class="form-control" id="alloted_date"  name="alloted_date" value="<?php if(isset($userInfo[0]->ALLOTEDDATE)) echo  $userInfo[0]->ALLOTEDDATE;?>" >
                                    </div>  
                                  </div> 
                                  <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="expiry_date">EXPIRY DATE</label>
                                        <input type="text" readonly class="form-control" id="expiry_date"  name="expiry_date" value="<?php if(isset($userInfo[0]->EXPIRYDATE)) echo $userInfo[0]->EXPIRYDATE;?>"  >

                                        <input type="hidden" class="form-control" id="hostel"  name="expiry_date" value="<?php if(isset($userInfo[0]->EXPIRYDATE)) echo $userInfo[0]->EXPIRYDATE;?>"  >
                                     </div> 
                                </div>
                            </div>
                       
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            
                        </div>

                    </form>
                </div>
            </div> 
             <div class="col-md-4">
                <?php
                   
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

<script src="<?php echo base_url(); ?>assets/js/report.js" type="text/javascript"></script>