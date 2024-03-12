 <?php
 $regno = $studentdetail[0]->REGNO; $gender = $studentdetail[0]->GENDER;
 $CI =& get_instance();
 $fnumber = $CI->visitor_model->StudAppInfo($regno, $gender);

 ?>
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
                    
                    <form role="form" id="visitor" action="<?php echo base_url() ?>visitor/Visitor/addNewVisitor" method="post" role="form">
                        <div class="box-body">
                         <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="roomdesc">Visitor #</label>
                                        <input type="text" class="form-control required" id="vno"  name="vno" maxlength="120" value ="<?php if(empty($visitno)){echo "01";}else {echo '0'.$visitor = $visitno+1; }?>" readonly>
                                        
                                     </div>
                                    </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" value="<?php echo $studentdetail[0]->REGNO?>" readonly>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" value="<?php echo $studentdetail[0]->NAME?>" readonly>
                                        
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Gender</label>
                                       <input type="text" class="form-control required" id="gender"  name="gender" maxlength="120" readonly value="<?php echo $studentdetail[0]->GENDER?>">
                                    </div>
                                </div>
                                   <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="10" readonly value="<?php echo $studentdetail[0]->HOSTELDESC?>">
                                    </div>
                                  </div>
                                  <div class="col-md-1">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No</label>
                                       <input type="text" class="form-control required" maxlength="10" readonly value="<?php echo $studentdetail[0]->HOSTEL_NO?>">
                                       <input type="hidden" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly value="<?php echo $studentdetail[0]->HOSTELID?>">
                                    </div>
                                  </div>
                                  
                            </div>
                            <div class="row">     
                               <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" maxlength="10" readonly value="<?php echo $studentdetail[0]->ROOMDESC?>">
                                        <input type="hidden" class="form-control required" id="roomno" name="roomno" maxlength="10" readonly value="<?php echo $studentdetail[0]->ROOMID?>">
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="roomtype" name="roomtype" maxlength="10" readonly value="<?php echo $studentdetail[0]->ROOMTYPE?>">
                                    </div>
                                  </div>
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat No.</label>
                                        <input type="text" class="form-control required"  maxlength="10" readonly value="<?php echo $studentdetail[0]->SEAT?>">
                                         <input type="hidden" class="form-control required" id="seatno" name="seatno" maxlength="10" readonly value="<?php echo $studentdetail[0]->SEATID?>">
                                    </div>
                                  </div>
                          
                            </div> <!-- Seat detail div end (div row end) -->
                           
                            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Enter Visitor Detail</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visitname">Father Name</label>
                                        
                                       <input type="text" class="form-control required" id="visitname"  name="visitname" value="<?php if(!empty($visitorinfo[0]->VNAME)) echo $studentinfo[0]->FNAME; else { echo $studentinfo[0]->FNAME; }?>" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="relation">Relation</label>
                                     <input type="text" class="form-control" id="relation"  name="relation" value="Father" readonly> 					
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cnic">CNIC No.</label>
                                       <input type="text" class="form-control" id="cnic"  name="cnic" value="<?php echo $visitorinfo[0]->VNICNO ?>"> 
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Father Number</label>
                                       <input type="number" class="form-control" id="number"  name="number" maxlength="11" value="<?php if(!empty($visitorinfo[0]->CONTACTNO)) echo $visitorinfo[0]->CONTACTNO; else echo $fnumber[0]->FATHERNUMBER; ?>" > 
                                    </div>
                                </div>
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Remarks.</label>
                                        <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $visitorinfo[0]->VREMARKS ?>" >
                                    </div>
                                  </div>
                                
                       </div>
                       <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="visitname">Visitor Name</label>
                                       <input type="text" class="form-control" id="visitname2"  name="visitname2" value="<?php if(!empty($visitorinfo[0]->VNAME2 )) echo $visitorinfo[0]->VNAME2; else echo $fnumber[0]->EPERSONNAME; ?>" > 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="relation">Relation</label>
                                      <!-- <input type="text" class="form-control" id="relation2"  name="relation2" value="<?php //echo $visitorinfo[0]->RELATION2 ?>" > -->
                                        <select class="form-control required" id="relation2" name="relation2">
                                            <option value="<?php if($visitorinfo[0]->RELATION2) echo $visitorinfo[0]->RELATION2; ?>"><?php if($visitorinfo[0]->RELATION2) {echo $visitorinfo[0]->RELATION2; } else { echo 'Select Relative';} ?></option>
                                            <option value="Mother">Mother</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Relatives">Relatives</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cnic">CNIC No.</label>
                                       <input type="text" class="form-control" id="cnic2"  name="cnic2" maxlength="15" value="<?php echo $visitorinfo[0]->VNICNO2 ?>"> 
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Contact No</label>
                                       <input type="number" class="form-control" id="number2"  name="number2" maxlength="11" value="<?php if(!empty($visitorinfo[0]->CONTACTNO2)) echo $visitorinfo[0]->CONTACTNO2; else echo $fnumber[0]->EPERSONNUMBER; ?>" > 
                                       <input type="hidden" class="form-control" id="allottype"  name="allottype" value="<?php echo $studentinfo[0]->ALLOTTYPE ?>" > 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                       <!--<input type="number" class="form-control" id="fnumber"  name="fnumber" maxlength="11" value="<?php //echo $visitorinfo[0]->FATHERNUMBER ?>" >--> 
                                        <textarea id="address" name="address" class="md-textarea form-control" rows="2"><?php if(!empty($visitorinfo[0]->VADDRESS)) echo $visitorinfo[0]->VADDRESS; else { echo $studentinfo[0]->ADDRESS; }?></textarea>
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