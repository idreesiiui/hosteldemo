 <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
		.grey-11 {
    font: 9px Arial,Helvetica,sans-serif;
    color: #999;
    text-decoration: none;
}
    </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Change/Interchange
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Seat Change/Interchange Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="seatinterchange" action="<?php echo base_url() ?>seatswap/Interchange/addNewapp" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="regno">Reg No.</label>
                                        <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $StudentInfo[0]->REGNO ?>" readonly>
                                        <input type="hidden" class="form-control required" id="gender" name="gender" maxlength="128" value="<?php echo $StudentInfo[0]->GENDER ?>" readonly>
                                        
                                        <input type="hidden" class="form-control required" id="semcode" name="semcode" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value="<?php echo $StudentInfo[0]->STUDENTNAME ?>">
                                          
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Father Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" readonly value="<?php echo $StudentInfo[0]->FATHERNAME ?>">
                                         
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Department Name</label>
                                        <input type="text" class="form-control required" id="deptname" name="deptname" readonly value="<?php echo $StudentInfo[0]->DEPARTNAME ?>">
                                    </div>  
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline; color: #1C6C1B;"><b>Enter the current Hostel & Room</b></h3>
                    </div>
                    </div>
                   
                                <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Current Hostel <span class="grey-11">(Your Existed Hostel No) </span></label>
                                         <input type="text" class="form-control required" id="chostel" name="chostel" readonly value="<?php echo $StudentInfo[0]->HOSTEL_NO ?>">
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Current Hostel Name <span class="grey-11">(Your Existed Hostel) </span></label>
                                         <input type="text" class="form-control required" id="chostelname" name="chostelname" readonly value="<?php echo $StudentInfo[0]->HOSTELDESC ?>">
                                      </div>
                                </div>
                                <div class="col-md-3">
                                 <div class="form-group">
                                        <label for="room">Room No <span class="grey-11">(Enter Your Existed Room No) </span></label>
                                        <input type="number" class="form-control required" id="croomno"  name="croomno" maxlength="128" value="<?php echo $StudentInfo[0]->ROOMDESC ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                               <div class="form-group">
                                        <label for="dob">Current Seat <span class="grey-11">(Select Existed Seat Menu) </span></label>
                                        <input type="text" class="form-control required" id="cseat" name="cseat" readonly value="<?php echo $StudentInfo[0]->SEAT ?>">
                                      </div>
                                </div>
                                </div>
                                <div class="box box-primary" id="one">
                                </div>
                                <div id = "btn"><!--- div button start here --> 
                   <a class="btn btn-app" id="interchange" style="background-color:#4CAF50 !important; color:#fff; font-weight:bold"><i class="fa fa-building"></i> Seat Interchange with other Student</a>
                   <a class="btn btn-app" id="vacant" style="background-color:#008CBA !important; color:#fff; font-weight:bold"><i class="fa fa-bullhorn"></i> Transfer to Vacant Seat</a>
                   <div class="alert alert-danger" role="alert" style="width:50%; margin-top:-6%; margin-left:37%">
  <strong>Note!</strong> You can chose one option Only. Once you submit form you can't edit.
</div>
                   </div> 
                            <!-- Seat detail div end (div row end) -->
                            <div id="vacantdetail" style="display:none">
                                 <div class="box box-primary">
                                 
                                <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline; color: #F04346;"><b>Transfer To Vacant Seat Only</b></h3>
                    </div>
                    </div>
                                 
                                <div class="row">
                                 <div class="col-md-3">
                                 <div class="form-group">
                                        <label for="dob">New Hostel <span class="grey-11">(Select New Hostel No Drop Down) </span></label>
                                       <input type="text" class="form-control required" id="newhostelno" name="newhostelno" readonly value="<?php echo $StudentInfo[0]->HOSTEL_NO ?>">
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Current Hostel Name <span class="grey-11">(Your Existed Hostel) </span></label>
                                         <input type="text" class="form-control required" id="chostelname" name="chostelname" readonly value="<?php echo $StudentInfo[0]->HOSTELDESC ?>">
                                         <input type="hidden" class="form-control required" id="hostelid" name="hostelid" readonly value="<?php echo $StudentInfo[0]->HOSTELID ?>">
                                      </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                        <label for="roomno">New Room No</label>
                                        <select class="form-control required" id="newroomno" name="newroomno">
                                            <option value=" ">Select New Room No</option>
                                            <?php
                                            if(!empty($RoomInfo))
                                            {
                                                foreach ($RoomInfo as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->ROOMID ?>"><?php echo $rl->ROOMDESC ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                <div class="col-md-3">
                               <div class="form-group">
                                        <label for="dob">New Seat <span class="grey-11">(Select New Seat from Drop Down) </span></label>
                                        <select class="form-control required" id="newseat" name="newseat">
                                            <option value="">Select New Seat</option>
                                        </select>
                                      </div>
                                </div>
                                </div>
                             </div>
                             <div id="swap" style="display:none">
                                 <div class="box box-primary">
                                 
                                <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline; color: #F04346;"><b>Seat Interchange/Swap Only </b><span class="grey-11">(Give detail of student wish you want to swap with (REGNO, ROOMNO,SEAT) <b style="color:#CD4346">Note! must be in same Hostel)</b></span></h3>
                    </div>
                    </div>
                                 
                                <div class="row">
                                 <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="regno">Swap Reg No.<span class="grey-11">(Printed on Student card)</span></label>
                                        <input type="text" class="form-control required" id="swapregno" placeholder="123-FBAS/BSSE/S10" name="swapregno" maxlength="128" >
                                       
                                    </div>
                                    
                                </div>
                                 <div class="col-md-2">
                                 <div class="form-group">
                                        <label for="dob">Swap Hostel</label>
                                       <input type="text" class="form-control required" id="swaphostelno" name="swaphostelno" readonly >
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Swap Hostel Name <span class="grey-11">(Must be Same Hostel) </span></label>
                                         <input type="text" class="form-control required" id="swaphostelname" name="swaphostelname" readonly >
                                         
                                      </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                        <label for="roomno">Swap Room No</label>
                                        <input type="text" class="form-control required" id="swaproomno" name="swaproomno" readonly >
                                    </div>
                                  </div>
                                <div class="col-md-2">
                               <div class="form-group">
                                        <label for="dob">Swap Seat <span class="grey-11">(e.g(A,B,C,D)</span></label>
                                       <input type="text" class="form-control required" id="swapseat" name="swapseat" readonly >
                                      </div>
                                </div>
                                </div>
                                <div class="row>"
                                <div class="col-md-3">
                                   <div class="form-group">
                                        <label for="fname">Swap Student Name</label>
                                        <input type="text" class="form-control required" id="swapname" name="swapname" maxlength="128" readonly >
                                          
                                    </div>
                                </div>
                                </div>
                             

                        </div><!-- /.box-body -->
    
                        <div class="box-footer" style="display:none">
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
<script src="<?php echo base_url(); ?>assets/js/stseatinterchange.js" type="text/javascript"></script>