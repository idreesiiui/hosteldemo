<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Re-Allotment Management
        <small>Edit Re-Allotment</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Attachment Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                     <form role="form" id="reallotment" action="<?php echo base_url() ?>attachment/Attachment/viewAttachmentDetail" method="post" role="form">
                         <div class="box-body">
                         <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Gender</label>
                                       <input type="text" class="form-control required" id="gender"  name="gender" maxlength="120" readonly value="<?php echo $attachInfo[0]->GENDER ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" readonly value ="<?php echo $attachInfo[0]->HOSTREGNO?>">
                                        
                                    </div>
                                </div> 
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Name</label>
                                        <input type="text" class="form-control required" id="roomname" name="roomname" maxlength="50" readonly value ="<?php echo $attachInfo[0]->ROOMDESC?>">
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly value ="<?php echo $attachInfo[0]->ROOMID?>">
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="10" readonly value ="<?php echo $attachInfo[0]->HOSTELDESC?>">
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" id="roomno" name="roomno" maxlength="10" readonly value ="<?php echo $attachInfo[0]->ROOMID?>">
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat Name.</label>
                                        <input type="text" class="form-control required" id="seat" name="seat" maxlength="10" readonly value ="<?php echo $attachInfo[0]->SEAT?>">
                                    </div>
                                  </div>
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat No.</label>
                                        <input type="text" class="form-control required" id="seatno" name="seatno" maxlength="10" readonly value ="<?php echo $attachInfo[0]->SEATID?>">
                                    </div>
                                  </div>
                              <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value ="<?php echo $attachInfo[0]->STUDENTNAME?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Guest Reg No#</label>
                                        <input type="text" class="form-control" id="guestregno"  name="guestregno" maxlength="120" value ="<?php echo $attachInfo[0]->GUESTREGNO?>" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Guest Name</label>
                                        <input type="text" class="form-control required" id="guestname"  name="guestname" maxlength="120" value ="<?php echo $attachInfo[0]->GUESTNAME?>" readonly>
                                    </div>
                                </div>
                            </div> <!-- Seat detail div end (div row end) -->
                           
                   <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Attachment Allocation Detail</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Sem.Code</label>
                                       <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" value ="<?php echo $attachInfo[0]->SEMCODE?>"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Exp Date</label>
                                        <input type="date" class="form-control required" id="expdate"  name="expdate" maxlength="120" value ="<?php echo $attachInfo[0]->EXPIRYDATE?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Deposit Date</label>
                                         <input type="date" class="form-control required" id="depodate"  name="depodate" maxlength="120" value ="<?php echo $attachInfo[0]->DEPOSITDATE?>">
                                    </div>
                                </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Atachment Date</label>
                                        <input type="date" class="form-control required" id="attachdate"  name="attachdate" maxlength="120" value ="<?php echo $attachInfo[0]->RADATE?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Fee Due Date</label>
                                        <input type="date" class="form-control required" id="duedate"  name="duedate" maxlength="120" value ="<?php echo $attachInfo[0]->DUEDATE?>">
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Fee Amount</label>
                                         <input type="number" class="form-control required" id="feeamount"  name="feeamount" maxlength="120" value ="<?php echo $attachInfo[0]->HOSTELDUES?>">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                             <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Receipt No#</label>
                                        <input type="text" class="form-control required" id="recpno"  name="recpno" maxlength="120" value ="<?php echo $attachInfo[0]->RECEIPTNO?>">
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Arriers</label>
                                         <input type="number" class="form-control required" id="arrier"  name="arrier" maxlength="120" value ="<?php echo $attachInfo[0]->ARRIERS?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                             <option value="<?php echo $attachInfo[0]->ATACHSTATUS?>"><?php echo $attachInfo[0]->ATACHSTATUS?></option>
                                            <option value="PRESENT">PRESENT</option>
                                            <option value="LEFT">LEFT</option>
                                            <option value="REALLOTED">REALLOTED</option>
                                            <option value="CANCEL">CANCEL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Back" />
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

<script src="<?php echo base_url(); ?>assets/js/allotment.js" type="text/javascript"></script>