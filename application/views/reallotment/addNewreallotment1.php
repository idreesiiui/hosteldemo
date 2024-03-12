<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Re-Seat Allotment Management
        <small>Add Re-Seat Allotment</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Enter Seat Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="reallotment" action="<?php echo base_url() ?>Reallotment/reallotment/addNewreallotment" method="post" role="form">
                        <div class="box-body">
                         <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                            <option value="0">Select Status</option>
                                            <option value="ICT Sponosord">ICT Sponosord</option>
                                            <option value="WWF Sponsord">WWF Sponsord</option>
                                            <option value="HEC Sponsord">HEC Sponsord</option>
                                            <option value="Baitulmal">Baitulmal</option>
                                            <option value="Trust">Trust</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">R/Type</label>
                                        <select class="form-control required" id="rtype" name="rtype">
                                            <option value="">Select Reallocate</option>
                                            <option value="Seat Reallocate">Seat  Reallocate</option>
                                            <option value="Semester Reallocate">Semester Reallocate</option>
                                            <option value="Both">Both</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120">
                                        
                                    </div>
                                </div> 
                                 
                                 
                                 <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Seat Available<span style="color:grey; font-size:x-small"> (For different seat Allotment)</span></label>
                                        <select class="form-control required" id="seatavilabel" name="seatavilabel">
                                            <option value=" ">Select Seat</option>
                                            <?php
                                            if(!empty($seatdetail))
                                            {
                                                foreach ($seatdetail as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->SEATID ?>"><?php echo "<p style='color:red;'>".$rl->SEAT."</p>"." "."Room No"."  (".$rl->ROOMID.") Hostel ( ".$rl->HOSTELDESC." )" ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Name</label>
                                        <input type="text" class="form-control required" id="roomname" name="roomname" maxlength="10" readonly>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly>
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
                                    </div>
                                  </div>
                                 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly>
                                         <input type="hidden" class="form-control required" id="seatid"  name="seatid" maxlength="120" readonly>
                                    </div>
                                </div>
                            </div> <!-- Seat detail div end (div row end) -->
                           
                   <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Seat Allocation</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Sem.Code</label>
                                       <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Seat Alloted</label>
                                        <select class="form-control required" id="alloted" name="alloted">
                                            <option value=" ">Select Allotment</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Exp Date</label>
                                        <input type="date" class="form-control required" id="expdate"  name="expdate" maxlength="120">
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
                                        <label for="dob">Fee Amount</label>
                                         <input type="number" class="form-control required" id="feeamount"  name="feeamount" maxlength="120">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Receipt No#</label>
                                        <input type="text" class="form-control required" id="recpno"  name="recpno" maxlength="120">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">R.Dues</label>
                                         <input type="text" class="form-control required" id="rdues"  name="rdues" maxlength="120">
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

<script src="<?php echo base_url(); ?>assets/js/reallotment.js" type="text/javascript"></script>