<style>
/*Style the Image Used to Trigger the Modal */
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
	vertical-align:text-top;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
 
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Re-Allotment Management
        <small>Edit Seat Re-Allotment....</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
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
            <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Student Info</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="editallotment" action="<?php echo base_url() ?>reallotment/reAllotment/ApplyReAllotment" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                         <div class="row">
                         <div class="col-md-2" style="margin-top:-3em; float:right;">
                                    <div class="form-group">
                   <?php if(!empty($allotInfo[0]->REGNO)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" id="pic1" src="#" alt="your image" class="img-thumb" width=105 height=105 border=1/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105">
                        <?php }?>
                 
                       </div>
                          </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" readonly value="<?php echo $allotInfo[0]->REGNO ?>">
                                        
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" value="<?php echo $allotInfo[0]->STUDENTNAME?>" readonly>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="roomdesc">Father Name</label>
                                        <input type="text" class="form-control required" id="fname"  name="fname" maxlength="120" readonly value="<?php echo $allotInfo[0]->FATHERNAME?>">
                                        <input type="hidden" class="form-control required" id="programe"  name="programe" maxlength="120" readonly value="<?php echo $allotInfo[0]->PROGRAME?>">
                                        <input type="hidden" class="form-control required" id="batchname"  name="batchname" readonly value="<?php echo $allotInfo[0]->BATCHNAME?>">
                                    </div>
                                </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Course Joined</label>
                                         <input type="text" class="form-control required" id="course"  name="course" maxlength="120" readonly value="<?php echo 'Yes'?>">
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="row">
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Dept Name</label>
                                         <input type="text" class="form-control required" id="dname"  name="dname" maxlength="120" readonly value="<?php echo $allotInfo[0]->DEPARTNAME?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Program</label>
                                         <input type="text" class="form-control required" id="program"  name="program" maxlength="120" readonly value="<?php echo $allotInfo[0]->PROTITTLE?>">
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Faculty</label>
                                         <input type="text" class="form-control required" id="faculty"  name="faculty" maxlength="120" readonly value="<?php echo $allotInfo[0]->FACULTY?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Semester</label>
                                         <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" readonly value="<?php echo $semInfo[0]->SEMCODE?>">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Refrigerator</label>
                                         <select class="form-control required" required id="refrigerator" name="refrigerator">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Iron</label>
                                         <select required class="form-control" id="iron" name="iron">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Electrical Cooking POT</label>
                                         <select required class="form-control" id="epot" name="epot">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Room Cooler</label>
                                         <select required class="form-control" id="rcooler" name="rcooler">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Air Conditioner</label>
                                         <select required class="form-control" id="aircond" name="aircond">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Electric Heater</label>
                                         <select required class="form-control" id="eheater" name="eheater">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                                <div class="row">
                                   <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Oven</label>
                                         <select required class="form-control" id="oven" name="oven">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Washing Machine</label>
                                         <select required class="form-control" id="wmachine" name="wmachine">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Electric Kettle</label>
                                         <select required class="form-control" id="ekettle" name="ekettle">
                                            <option value="">Select Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Fee Amount.</label>
                                         <input required type="number" class="form-control" id="fee"  name="fee" maxlength="6" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Challan No.</label>
                                         <input required type="number" class="form-control" id="vno"  name="vno" maxlength="25" >
                                    </div>
                                </div>

                            </div>
                             <div class="row">
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Father Mobile No</label>
                                         <input required type="number" class="form-control" required id="fatherph"  name="fatherph" maxlength="11" minlength="11">
                                    </div>
                                </div>
                            
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="occupy">Father Occupation</label>
                                         <input type="text" class="form-control" required id="fatherocup"  name="fatherocup" maxlength="256">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">First Allotment</label>
                                         <input type="text" class="form-control" readonly required id="hostelbatch"  name="hostelbatch" value="<?php echo $allotInfo[0]->HOSTELBATCH?>">
                                    </div>
                                </div>
                            </div>
                     </div>
                           
                              
                     <?php 
						   if($challanstatus[0]->publish == 1)
						     {
					  ?>
                        <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Apply" />
                          <input type="reset" class="btn btn-default" value="Cancel" />
                      </div>
                      <?php
							 }
							 elseif($challanstatus[0]->publish == 0)
							 { 
					  ?>
                      <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible" style="font-size:medium">
                        <i class="icon fa fa-warning"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php echo 'Fee Challan is genrated but not published due to document verification. Verify your document to Provost office to Publish Challan..' ?>                    
                      </div> 
                  </div>
                      <?php 
							 }
					   ?>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
    
</div>

<script src="<?php echo base_url(); ?>assets/js/editallotment.js" type="text/javascript"></script>