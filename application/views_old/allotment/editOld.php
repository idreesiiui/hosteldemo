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
        Seat Allotment Management
        <small>Edit Seat Allotment</small>
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
                        <h3 class="box-title" style="text-decoration:underline">Enter Seat Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="editallotment" action="<?php echo base_url() ?>allotment/allotment/editallotment" method="post" role="form">
                        <div class="box-body">
                         <div class="row">
                         <div class="col-md-2" style="margin-top:-3em; float:right;">
                                    <div class="form-group">
                    <?php if(!empty($allotInfo[0]->ALLOTMENT_ID) && !empty($oraclepic)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105" style="padding:1px; border:1px solid #021a40; background-color:#fff;">
                        <?php }?>
                 
                 
                       </div>
                          </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Status</label>
                                         <select class="form-control required" id="status" name="status">
                                            <option value="<?php echo $allotInfo[0]->SEATSTATUS ?>"><?php echo $allotInfo[0]->SEATSTATUS ?></option>
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
                                            <option value="<?php echo $allotInfo[0]->QUOTA_TYPE?>"><?php if ($allotInfo[0]->QUOTA_TYPE == 'NO') echo 'None Quota'?></option>
                                            <option value="NO">None Quota</option>
                                            <option value="PQ">President Quota</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-2">                                
                                    <div class="form-group">
                                       <label for="hostel">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="100" value="<?php echo $allotInfo[0]->HOSTEL_NO?>"  readonly>
                                      
                                         <input type="hidden" class="form-control required" id="oldhostel"  name="oldhostel" maxlength="120"  value="<?php echo $hostelno ?>">
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="100" value="<?php echo $allotInfo[0]->HOSTELDESC?>"  readonly>
                                    </div>
                                  </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                    <label for="hostel">Room No.</label>
                                         <input type="text" class="form-control required" id="roomno" name="roomno" maxlength="100" value="<?php echo $allotInfo[0]->ROOMDESC?>"  readonly>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room TYPE</label>
                                        <input type="text" class="form-control required" id="roomname" name="roomname" maxlength="10" value="<?php echo $allotInfo[0]->ROOMTYPE?>" readonly>
                                        <input type="hidden" class="form-control required" id="allotmentid" name="allotmentid" maxlength="10" readonly value="<?php echo $allotInfo[0]->ALLOTMENT_ID?>">
                                         <input type="hidden" class="form-control required" id="oldroom"  name="oldroom" maxlength="120"  value="<?php echo $roomno ?>">
                                    </div>
                                  </div>
                                  <div class="col-md-3">                                
                                    <div class="form-group">
                                       <label for="hostel">Seat Alloted</label>
                                             <select class="form-control required" id="seatavilabel" name="seatavilabel">
                                            <option value="<?php echo $allotInfo[0]->SEATID?>"><?php echo $allotInfo[0]->SEAT?></option>
                                            <?php if(!empty($seatdetail)) foreach ($seatdetail as $seats) {?>
                                            <option value="<?php  echo $seats->SEATID?>"><?php  echo $seats->SEAT?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control required" id="oldseat"  name="oldseat" maxlength="120"  value="<?php echo $allotInfo[0]->SEATID ?>">
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostelname">Key</label>
                                         <input type="text" class="form-control required" id="key" name="key" value="<?php echo $key[0]->KEY?>" style="text-transform:uppercase;" readonly>
                                    </div>
                                  </div>
                                   <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostelname">Remarks</label>
                                         <textarea id="remarks" name="remarks" class="md-textarea form-control" rows="2"><?php echo $allotInfo[0]->REMARKS?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostelname">Hostel Batch</label>
                                         <input type="text" class="form-control required" id="hbatch" name="hbatch" style="text-transform:uppercase;" value="<?php echo $allotInfo[0]->HOSTELBATCH?>" >
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
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120"  value="<?php echo $allotInfo[0]->REGNO ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" value="<?php echo $allotInfo[0]->STUDENTNAME?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Father Name</label>
                                        <input type="text" class="form-control required" id="fname"  name="fname" maxlength="120" readonly value="<?php echo $stPerInfo[0]->FATHERNAME?>">
                                         <input type="hidden" class="form-control required" id="cnic"  name="cnic" maxlength="120" readonly value="<?php echo $stPerInfo[0]->CNIC?>">
                                         <input type="hidden" class="form-control required" id="district"  name="district" maxlength="120" readonly value="<?php echo $stPerInfo[0]->DISTRICT?>">
                                         <input type="hidden" class="form-control required" id="protittle"  name="protittle" maxlength="120" readonly value="<?php echo $stPerInfo[0]->PROTITTLE?>">
                                         <input type="hidden" class="form-control required" id="country"  name="country" maxlength="120" readonly value="<?php if(isset($stPerInfo[0]->COUNTRY)) echo $stPerInfo[0]->COUNTRY?>">
                                         <input type="hidden" class="form-control required" id="caddress"  name="caddress" maxlength="120" readonly value="<?php if(isset($stPerInfo[0]->PREADD)) echo $stPerInfo[0]->PREADD?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Address</label>
                                         <input type="text" class="form-control required" id="address"  name="address" maxlength="120" readonly value="<?php echo $allotInfo[0]->ADDRESS?>">

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                         <input type="text" class="form-control required" id="phone"  name="phone" maxlength="120" readonly value="<?php echo $allotInfo[0]->STUDENTPHONE?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                         <input type="text" class="form-control required" id="dob"  name="dob" maxlength="120" readonly value="<?php echo $stPerInfo[0]->STUDENTDOB?>">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Dept Name</label>
                                         <input type="text" class="form-control required" id="dname"  name="dname" maxlength="120" readonly value="<?php echo $stPerInfo[0]->DEPARTMENTNAME?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Program</label>
                                         <input type="text" class="form-control required" id="program"  name="program" maxlength="120" readonly value="<?php echo $stPerInfo[0]->PROGRAME?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Faculty</label>
                                         <input type="text" class="form-control required" id="faculty"  name="faculty" maxlength="120" readonly value="<?php echo $stPerInfo[0]->FACULTY?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Nationality</label>
                                         <input type="text" class="form-control required" id="nationality"  name="nationality" maxlength="120" readonly value="<?php echo $stPerInfo[0]->NATIONALITY?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gend">Gender</label>
                                        <input type="text" class="form-control required" id="gend"  name="gend" maxlength="120"  value="<?php echo $allotInfo[0]->GENDER ?>" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gend">Email</label>
                                        <input type="email" class="form-control required" id="email"  name="email" maxlength="120"  value="<?php if(isset($allotemail[0]->email))echo $allotemail[0]->email ?>" style="text-transform:lowercase" >
                                        <input type="hidden" class="form-control required" id="emailid"  name="emailid" maxlength="120"  value="<?php if(isset($allotemail[0]->userId))echo $allotemail[0]->userId ?>" >
                                        
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
                                       <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" value="<?php echo $allotInfo[0]->SEMCODE ?>"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Seat Alloted</label>
                                        <select class="form-control required" id="alloted" name="alloted">
                                            <option value="<?php echo $allotInfo[0]->ALLOTED ?>"><?php 
											if($allotInfo[0]->ALLOTED == 1)
											echo "Yes";
											else echo "No" ?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Exp Date</label>
                                        <input type="text" class="form-control required" id="expdate"  name="expdate" maxlength="120" value="<?php echo $allotInfo[0]->EXPIRYDATE ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="arrdate">Arrival Date</label>
                                         <input type="text" class="form-control required" id="arrdate"  name="arrdate" maxlength="120" value="<?php echo $allotInfo[0]->ARRIVALDATE ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Deposit Date</label>
                                         <input type="text" class="form-control required" id="depodate"  name="depodate" maxlength="120" value="<?php echo $allotInfo[0]->DEPOSITDATE ?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dob">Fee Amount</label>
                                         <input type="number" class="form-control required" id="feeamount"  name="feeamount" maxlength="120" value="<?php echo $allotInfo[0]->FEEAMOUNT ?>">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                             <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="alloteddate">Alloted Date</label>
                                         <input type="text" class="form-control required" id="alloteddate"  name="alloteddate" maxlength="120" value="<?php echo $allotInfo[0]->ALLOTEDDATE ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Receipt No#</label>
                                        <input type="text" class="form-control required" id="recpno"  name="recpno" maxlength="120" value="<?php echo $allotInfo[0]->RECEIPTNO ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">R.Dues</label>
                                         <input type="text" class="form-control required" id="rdues"  name="rdues" maxlength="120" value="<?php echo $allotInfo[0]->RDUES ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                         <select class="form-control required" id="allotstatus" name="allotstatus">
                                            <option value="<?php echo $allotInfo[0]->STATUS ?>"><?php echo $allotInfo[0]->STATUS ?></option>
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
                                           
                                            <option selected value="<?php if($allotInfo[0]->CUPBOARDKEYSALLOTED == 1)echo 'Cupboard' ?>"><?php if ($allotInfo[0]->CUPBOARDKEYSALLOTED == 1) echo 'Cupboard/Keys Allot'; ?></option>
                                            <option value="Drawer">Drawer  Keys Alloted</option>
                                            <option value="Matress">Matress</option>
                                            <option value="Chair">Chair</option>
                                            <option value="Table">Table</option>
                                        </select>
                                    </div>
                                </div>                            </div>
                                <div class="row">
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="allotstatus">Allotment Status</label>
                                         <select class="form-control required" id="appstatus" name="appstatus">
                                            <option value="<?php echo $allotInfo[0]->ADMIN_VERIFY ?>"><?php if($allotInfo[0]->ADMIN_VERIFY == 0) echo 'Pending'; elseif( $allotInfo[0]->ADMIN_VERIFY == 1) echo 'Verfied';else echo 'Cancel'; ?></option>
                                            <option value="1">Verfiy</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Cancel</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="uploadfeeslip"> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alloteddate">Fee Slip</label><br>
                                    <!-- Trigger the Modal -->
                                <img id="myImg" src="<?php echo base_url() ?><?php if($allotInfo[0]->FEEPATH.$allotInfo[0]->FEEPIC != '') echo $allotInfo[0]->FEEPATH.$allotInfo[0]->FEEPIC; else echo '/assets/dist/img/cnic.png' ?>" alt="Hostel Fee Slip <?php echo $allotInfo[0]->SEMCODE?>" width="400" height="200">

                                <!-- The Modal -->
                                <div id="myModal" class="modal">

                                  <!-- The Close Button -->
                                  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

                                  <!-- Modal Content (The Image) -->
                                  <img class="modal-content" id="img01">

                                  <!-- Modal Caption (Image Text) -->
                                  <div id="caption"></div>
                                </div>
                 
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="pending">Pending Status</label>
                                         <select class="form-control required" id="upstatus" name="upstatus">
                                            <option value="<?php echo $allotInfo[0]->IS_SUBMIT?>"><?php if($allotInfo[0]->IS_SUBMIT == 0) echo 'Pending'; elseif( $allotInfo[0]->IS_SUBMIT == 1) echo 'Verfied';else echo 'Cancel'; ?></option>
                                            <option value="1">Verfiy</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Cancel</option>
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
            
        </div>    
    </section>
    
</div>

<script src="<?php echo base_url(); ?>assets/js/editallotment.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/imgpopup.js" type="text/javascript"></script>