<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Interchange Management
        <small>Student Seat Interchange/Shift</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Enter Seat Interchange Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="seatinterchange" action="<?php echo base_url() ?>seatswap/interchange/addNewallotment" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-top:-3em; float:right;">
                                    <div class="form-group">
                             <div id="allotmentid"></div>   
<!--                 <img src="../../../../assets/dist/img/-text.png" id="img" alt="your image" class="img-thumb" height="100" width="100">-->
                               
                       </div>
                          </div>
                         <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120">
                                         <input type="hidden" class="form-control required" id="gender"  name="gender" maxlength="120">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="studentname">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                    <label for="roomno">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno"  name="hostelno" maxlength="120" readonly>
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
                                       <input type="text" class="form-control required" id="roomno" name="roomno" readonly>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="roomtype" name="roomtype" maxlength="20" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Seat Alloted</label>
                                        <input type="text" class="form-control required" id="seat" name="seat" maxlength="20" readonly>
                                    </div>
                                  </div>
                    <div id = "btn" style="display:none"><!--- div button start here --> 
                   <a class="btn btn-app" id="interchange" style="background-color:#4CAF50 !important; color:#fff; font-weight:bold"><i class="fa fa-building"></i> Seat Interchange with other Student</a>
                   <a class="btn btn-app" id="vacant" style="background-color:#008CBA !important; color:#fff; font-weight:bold"><i class="fa fa-bullhorn"></i> Transfer to Vacant Seat</a>
                   </div> 
                            </div> <!-- Seat detail div end (div row end) -->
                  
                   <div id="vacantdetail" style="display:none">
                   <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Student transfer to Vacant Seat</h3>
                   </div>
 								<div class="row">
                				  <div class="col-md-2">                                
                                    <div class="form-group">
                                    <label for="roomno">Hostel No.</label>
                                    <select class="form-control required" id="vhostelno" name="vhostelno">
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
                                  <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostelname">Hostel Name</label>
                                         <input type="text" class="form-control required" id="vhostelname" name="vhostelname" readonly >
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                          <select class="form-control required" id="vroomno" name="vroomno">
                                          <option value="">Select Room No</option>
                                          </select>
                                    </div>
                                  </div>
                            	<div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="vroomtype" name="vroomtype" maxlength="20" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Seat Alloted</label>
                                        <select class="form-control required" id="vseat" name="vseat">
                                          <option value="">Select Vacant Seat</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Key</label>
                                        <input type="text" class="form-control required" id="key" name="key" required  >
                                    </div>
                                  </div>
                               </div>
                        
					</div><!--- div vacant detail end here -->
                 </div>
             </div>
               <div id = "swap" style="display:none">  <!--- div swap start here -->       
                 <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Students Interchange Info</h3>
                   </div>
                     <div class="row">
                            <div class="col-md-2" style="margin-top:-2em; float:right;">
                                    <div class="form-group">
                             <div id="swapallotmentid"></div>   
                 <!--<img src="../../../../assets/dist/img/-text.png" id="swapimg" alt="your image" class="img-thumb" height="100" width="100">-->
                          </div>
                             </div>
                              <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="swapregno"  name="swapregno" maxlength="120">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="studentname">Student Name</label>
                                        <input type="text" class="form-control required" id="swapstudentname"  name="swapstudentname" maxlength="120" readonly>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                    <label for="roomno">Hostel No.</label>
                                       <input type="text" class="form-control required" id="swaphostelno"  name="swaphostelno" maxlength="120" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostelname">Hostel Name</label>
                                         <input type="text" class="form-control required" id="swaphostelname" name="swaphostelname" readonly>
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room No.</label>
                                       <input type="text" class="form-control required" id="swaproomno" name="swaproomno" readonly>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="swaproomtype" name="swaproomtype" maxlength="20" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Seat Alloted</label>
                                        <input type="text" class="form-control required" id="swapseat" name="swapseat" maxlength="20" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Key</label>
                                        <input type="text" class="form-control required" id="key" name="key" required  >
                                    </div>
                                  </div>
                               </div>
 												<!-- Seat detail div end (div row end) -->
				 </div> <!--- div swap end here -->
 			</div>				                
                 <div class="box box-primary">
                    
                       
    
                        <div class="box-footer" style="display:none">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </div><!-- /.box-body -->
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

<script src="<?php echo base_url(); ?>assets/js/seatinterchange.js" type="text/javascript"></script>