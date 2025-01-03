<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Attachment Management
        <small>Add New Attachment</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Enter Attachment Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                   <form role="form" id="allotment" action="<?php echo base_url() ?>attachment/attachment/addNewattachment" method="post" role="form" >
                        <div class="box-body">
                         <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly>
                                      
                                    </div>
                                </div> 
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly>
                                       <input type="hidden" class="form-control required" id="hostelid" name="hostelid" maxlength="10" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="10" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" id="roomno" name="roomno" maxlength="10" readonly>
                                         <input type="hidden" class="form-control required" id="roomid" name="roomid" maxlength="100" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="roomtype" name="roomtype" maxlength="50" readonly>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat No.</label>
                                        <input type="text" class="form-control required" id="seat" name="seat" maxlength="10" readonly>
                                         <input type="hidden" class="form-control required" id="seatid" name="seatid" maxlength="10" readonly>
                                    </div>
                                  </div>
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Attachi Reg No.</label>
                                        <input type="text" class="form-control" id="attachregno"  name="attachregno" maxlength="120" required>
                                        
                                    </div>
                                </div>    
                              <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Attachi Name</label>
                                        <input type="text" class="form-control required" id="attachname"  name="attachname" maxlength="120" readonly required>
                                          <input type="hidden" class="form-control required" id="cnic"  name="attachcnic" maxlength="120" readonly required> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Attachi Email</label>
                                         <input type="email" class="form-control required" id="email"  name="email" maxlength="120" required>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Attachi Mobile</label>
                                        <input type="number" class="form-control required" id="attachimobile"  name="attachimobile" maxlength="11" required >
                                        
                                        
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
                                       <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" value="<?php echo $seminfo[0]->SEMCODE ?>" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Exp Date</label>
                                        <input type="text" class="form-control required" id="expdate"  name="expdate" maxlength="120" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Deposit Date</label>
                                         <input type="date" class="form-control required" id="depodate"  name="depodate" maxlength="120">
                                    </div>
                                </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Atachment Date</label>
                                        <input type="date" class="form-control required" id="attachdate"  name="attachdate" maxlength="120">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Fee Amount</label>
                                         <input type="number" class="form-control required" id="feeamount"  name="feeamount" maxlength="120">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                             <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Challan No.</label>
                                        <input type="text" class="form-control required" id="challanno"  name="challanno" maxlength="120">
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Arriers</label>
                                         <input type="number" class="form-control required" id="arrier"  name="arrier" maxlength="120" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                             <option value="Attachment">Attachment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Key</label>
                                         <input type="text" class="form-control required" id="key"  name="key" maxlength="120" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Remarks</label>
                                         <textarea class="form-control" id="remarks"  name="remarks" maxlength="500" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                         <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" id="submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
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

<script src="<?php echo base_url(); ?>assets/js/attachment.js" type="text/javascript"></script>