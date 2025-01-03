<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Add Remarks <small>for student</small> </h1>
    </section>    
    <section class="content">    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Students Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->                    
                    <form action="<?= base_url('store-remarks'); ?>"  method="post" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="REGNO" maxlength="120" value="<?= ($student[0]->REGNO) ??''; ?>" readonly>
                                        
                                        
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="NAME" maxlength="120" value="<?= ($student[0]->NAME) ??''; ?>" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:-2%">
                                    <div class="form-group">
                 <?php if(!empty($oraclepic)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?= '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?= base_url('uploads/image/noimg.png')?>" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105" style="padding:1px; border:1px solid #021a40; background-color:#fff;">
                        <?php }?>
                
                       </div>
                          </div>
                             </div>
                              <div class="row">
                              <div class="col-md-1">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No</label>
                                       <input type="text" class="form-control required" id="hostelno" name="HOSTEL_NO"  readonly value="<?= ($student[0]->HOSTEL_NO) ?? ''; ?>">
                                    </div>
                                  </div>
                                  <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="HOSTELDESC" readonly value="<?= ($student[0]->HOSTELDESC) ?? ''; ?>">
                                    </div>
                                  </div>
                                  
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" name="ROOMDESC" readonly value="<?= ($student[0]->ROOMDESC) ?? ''; ?>">
                                    </div>
                                  </div>
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat No.</label>
                                        <input type="text" class="form-control required" name="SEAT" readonly value="<?= ($student[0]->SEAT) ?? '';?>">
                                    </div>
                                  </div>
                           <!-- <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="issuedate">Issue Date</label>
                                        <input type="text" class="form-control required" id="issuedate" name="issuedate" value="<?= ($student[0]->ISSUEDATE) ?? ''; ?>" readonly>
                                    </div>
                                  </div>-->
                            <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="expdate">Remarked By</label>
                                        <input type="text" class="form-control required" id="expdate" name="expdate" value="<?= ($student[0]->remarked_by) ?? ''; ?>" readonly>
                                    </div>
                                  </div>       
                            
                        </div>  
                            <!-- Seat detail div end (div row end) -->
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="issuedate">Remarks:</label>
                                    <textarea  class="form-control required" required name="REMARKS"><?php if(!empty($student[0]->REMARKS)) {
                                            echo trim(htmlspecialchars($student[0]->REMARKS));
                                        } else {
                                            echo '';
                                        } ; ?></textarea>
                                </div>
                            </div>
                        </div>
                        </div><!-- /.box-body -->
                        
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Add Remarks" />
                            <a href="<?= base_url('add-remarks'); ?>" class="btn btn-default">Back</a>
                           
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

<script src="<?php echo base_url(); ?>assets/js/card.js" type="text/javascript"></script>