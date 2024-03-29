<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Re-Allotment Management
        <small>Add Seat Re-Allotment</small>
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
                    
                    <form role="form" id="reallotment" action="<?php echo base_url() ?>reallotment/reallotment/addNewreallotment" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-top:-3em; float:right;">
                                    <div class="form-group">
                                        
               <!--  <img src="<?php //echo base_url() ?>/assets/dist/img/-text.png" id="pic1" id="allotmentid" src="#" alt="your image" class="img-thumb">
                
                 	<input type="file"  onchange="pic1readURL(this);" id="pic1" name="pic1" class="form-control" style="width:7.5em"><p class="help-block" style="color:#dd4b39; font-size:10px">JPEG,JPG,GIF,PNG Max Size (2MB)</p>-->
                 
                       </div>
                          </div>
                          
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="Self Finace">Self Finance</option>
                                            <option value="ICT">ICT Sponosord</option>
                                            <option value="WWF">WWF Sponsord</option>
                                            <option value="HEC">HEC Sponsord</option>
                                            <option value="Baitulmal">Baitulmal</option>
                                            <option value="Trust">Trust</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Quota Type</label>
                                        <select class="form-control required" id="seatoccupy" name="seatoccupy">
                                            <option value="">Select Quota</option>
                                            <option value="NO">None Quota</option>
                                            <option value="PQ">President Quota</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No.</label>
                                       <select class="form-control required" id="hostelno" name="hostelno">
                                            <option value="">Select Hostel</option>
                                            <?php if(!empty($hosteldetail)) {
												foreach($hosteldetail as $hostel)
												{
												?>
                                            <option value="<?php echo $hostel->HOSTELID?>"><?php echo $hostel->HOSTEL_NO?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostelname">Hostel Name</label>
                                         <input type="text" class="form-control required" id="hostelname" name="hostelname" readonly>
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                        <select class="form-control required" id="roomno" name="roomno">
                                            <option value=" ">Select Room</option>
                                         </select>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="roomname" name="roomname" maxlength="20" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Seat Available</label>
                                        <select class="form-control required" id="seatavilabel" name="seatavilabel">
                                            <option value=" ">Select Seat</option>
                                        </select>
                                    </div>
                                  </div>
                            </div> <!-- Seat detail div end (div row end) -->
                           
                 <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Students Info</h3>
                   </div>
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
                                        <label for="roomdesc">Father Name</label>
                                        <input type="text" class="form-control required" id="fname"  name="fname" maxlength="120" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Address</label>
                                         <input type="text" class="form-control required" id="address"  name="address" maxlength="120" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                         <input type="text" class="form-control required" id="phone"  name="phone" maxlength="120" >
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Allotment Status</label>
                                         <input type="text" class="form-control required" id="allotstatus"  name="allotstatus" value="ReAllotment" maxlength="120" >
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Dept Name</label>
                                         <input type="text" class="form-control required" id="dname"  name="dname" maxlength="120" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Program Tittle</label>
                                         <input type="text" class="form-control required" id="program"  name="program" maxlength="120" readonly>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Faculty</label>
                                         <input type="text" class="form-control required" id="faculty"  name="faculty" maxlength="120" readonly>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Nationality</label>
                                         <input type="text" class="form-control required" id="nationality"  name="nationality" maxlength="120" readonly>
                                         
                                          
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gend">Gender</label>
                                         <input type="text" class="form-control required" id="gend"  name="gend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gend">CNIC/Passport</label>
                                         <input type="text" class="form-control required" id="cnic"  name="cnic" >
                                    </div>
                                </div>
                               
                                </div>
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Province</label>
                                        <select class="form-control required" id="province"  name="province">
                                        <option value="">Select Province</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Sindh">Sindh</option>
                                            <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                            <option value="Balochistan">Balochistan</option>
                                            <option value="Azad Kashmir">Azad Kashmir</option>
                                            <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="FATA">FATA</option>
                                            <option value="Overseas">Overseas</option>
                                            <option value="Foreigner">Foreigner</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">District</label>
                                       <input type="text" class="form-control required" id="district"  name="district" maxlength="120" > 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Country</label>
                                <input type="text" class="form-control required" id="country"  name="country" maxlength="120" >
                                </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="roomdesc">Present Address</label>
                                <input type="text" class="form-control required" id="preadd"  name="preadd" maxlength="120">
                                </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gend">Email/Email ID</label>
                                        <input type="email" class="form-control" id="email"  name="email" maxlength="120" >
                                        <input type="number" class="form-control" id="emailid"  name="emailid" maxlength="120"  >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Seat Allocation</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Sem.Code</label>
                                       <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" value="FALL-2018"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Seat Alloted</label>
                                        <select class="form-control required" id="alloted" name="alloted">
                                            <option value="1">Yes</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Exp Date</label>
                                        <input type="text" class="form-control required" id="expdate"  name="expdate" maxlength="120" value="30/06/2018">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="arrdate">Arrival Date</label>
                                         <input type="text" class="form-control required" id="arrdate"  name="arrdate" maxlength="120" value="01/02/2018" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Deposit Date</label>
                                         <input type="date" class="form-control required" id="depodate"  name="depodate" maxlength="120" >
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Fee Amount</label>
                                         <input type="number" class="form-control required" id="feeamount"  name="feeamount" maxlength="120" value="0">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                             <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="alloteddate">Alloted Date</label>
                                         <input type="text" class="form-control required" id="alloteddate"  name="alloteddate" maxlength="120" value="05/03/2018">
                                         <input type="hidden" class="form-control required" id="rtype" name="rtype" maxlength="10" value="First Allotment" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Receipt No#</label>
                                        <input type="text" class="form-control required" id="recpno"  name="recpno" maxlength="120" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">R.Dues</label>
                                         <input type="text" class="form-control required" id="rdues"  name="rdues" maxlength="120" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                         <select class="form-control required" id="allotstatus" name="allotstatus">
                                            <option value="PRESENT">PRESENT</option>
                                            <option value="PRESENT">PRESENT</option>
                                            <option value="LEFT">LEFT</option>
                                            <option value="REALLOTED">REALLOTED</option>
                                            <option value="CANCEL">CANCEL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="allotedItem">Alloted Item</label><span style="font-size:12px; color:grey;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;(Ctrl+click to select more than one item)</span>
                                         <select class="form-control required" id="allotitem" name="allotitem[]" multiple>
                                           
                                            <option selected value="Cupboard">Cupboard/Keys Allot</option>
                                            <option selected value="Drawer">Drawer  Keys Alloted</option>
                                            <option selected value="Matress">Matress</option>
                                            <option selected value="Chair">Chair</option>
                                            <option selected value="Table">Table</option>
                                        </select>
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

<script src="<?php echo base_url(); ?>assets/js/addnewreallotment.js" type="text/javascript"></script>