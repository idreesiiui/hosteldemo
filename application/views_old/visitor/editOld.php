<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Visitor Management
        <small>Add Visitors</small>
      </h1>
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
                    
                    <form role="form" id="visitor" action="<?php echo base_url() ?>visitor/Visitor/EditVisitors" method="post" role="form">
                        <div class="box-body">
                         <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="roomdesc">Visitor #</label>
                                        <input type="text" class="form-control required" id="vno"  name="vno" maxlength="120"value ="<?php echo $visitorInfo[0]->VISTOR_NO?>" readonly>
                                         <input type="hidden" class="form-control required" id="visitid"  name="visitid" maxlength="120" value ="<?php echo $visitorInfo[0]->VISITORID?>">
                                        
                                     </div>
                                    </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" value="<?php echo $visitorInfo[0]->REGNO?>" readonly>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" value="<?php echo $visitorInfo[0]->STUDENTNAME?>" readonly>
                                        
                                    </div>
                                </div>
                                    <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="occupy">Gender</label>
                                       <input type="text" class="form-control required" id="gender"  name="gender" maxlength="120" readonly value="<?php echo $visitorInfo[0]->GENDER?>">
                                    </div>
                                </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Name</label>
                                        <input type="text" class="form-control required" id="roomname" name="roomname" maxlength="50" readonly value="<?php echo $visitorInfo[0]->ROOMDESC?>"> 
                                    </div>
                                  </div>
                                  <div class="col-md-1">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly value="<?php echo $visitorInfo[0]->HOSTELID?>">
                                    </div>
                                  </div>
                                  
                            </div>
                            <div class="row">
                             <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="10" readonly value="<?php echo $visitorInfo[0]->HOSTELDESC?>">
                                    </div>
                                  </div>
                                  
                             <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" id="roomno" name="roomno" maxlength="10" readonly value="<?php echo $visitorInfo[0]->ROOMID?>">
                                    </div>
                                  </div>
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat No.</label>
                                        <input type="text" class="form-control required" id="seatno" name="seatno" maxlength="10" readonly value="<?php echo $visitorInfo[0]->SEATID?>">
                                    </div>
                                  </div>
                           <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="seatno">Remarks.</label>
                                        <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $visitorInfo[0]->VREMARKS?>">
                                    </div>
                                  </div>
                            </div> <!-- Seat detail div end (div row end) -->
                           
                            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Edit Visitors Detail</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visitname">Visitor Name.</label>
                                       <input type="text" class="form-control required" id="visitname"  name="visitname" maxlength="120" value="<?php echo $visitorInfo[0]->VNAME?>"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="relation">Relation</label>
                                       <input type="text" class="form-control" id="relation"  name="relation" maxlength="120" value="<?php echo $visitorInfo[0]->RELATION?>" > 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cnic">CNIC#</label>
                                       <input type="text" class="form-control" id="cnic"  name="cnic" maxlength="15" value="<?php echo $visitorInfo[0]->VNICNO?>"> 
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact No</label>
                                       <input type="number" class="form-control" id="number"  name="number" maxlength="11" value="<?php echo $visitorInfo[0]->CONTACTNO?>">  
                                    </div>
                                </div>
                                
                       </div>
                       <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visitname">Visitor Name</label>
                                       <input type="text" class="form-control" id="visitname2"  name="visitname2" maxlength="120"  value="<?php echo $visitorInfo[0]->VNAME2?>">  
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="relation">Relation</label>
                                       <input type="text" class="form-control" id="relation2"  name="relation2" maxlength="120"  value="<?php echo $visitorInfo[0]->RELATION2?>">  
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cnic">CNIC#</label>
                                       <input type="text" class="form-control" id="cnic2"  name="cnic2" maxlength="15"  value="<?php echo $visitorInfo[0]->VNICNO2?>"> 
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact No</label>
                                       <input type="number" class="form-control" id="number2"  name="number2" maxlength="11"  value="<?php echo $visitorInfo[0]->CONTACTNO2?>">  
                                    </div>
                                </div>
                                
                       </div>
                             </div>
                   
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="button" class="btn btn-default" value="Back"  onclick="location.href='<?php echo base_url() ?>visitor/Visitor/viewVisitorDetailbyId'"/>
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

<script src="<?php echo base_url(); ?>assets/js/visitor.js" type="text/javascript"></script>