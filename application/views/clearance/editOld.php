<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Clearance Management
        <small>Edit Clearance</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Enter Clearance Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="clearance" action="<?php echo base_url() ?>clearance/clearance/editClearance" method="post" role="form">
                        <div class="box-body">
                         <div class="row">
                          <div class="col-md-2" style="margin-top:-3em; float:right;">
                                    <div class="form-group">
                    <?php if(!empty($viewclearance[0]->CLR_NO)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 0%;margin-top: 0%;" width=105 height=105 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="105" height="105">
                        <?php }?>
                 
                 
                       </div>
                          </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" value="<?php echo $viewclearance[0]->REGNO?>" readonly>
                                        <input type="hidden" class="form-control required" id="clearid"  name="clearid" maxlength="120" value="<?php echo $viewclearance[0]->CLR_NO?>" readonly>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php echo $viewclearance[0]->STUDENTNAME?>">
                                        
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Gender</label>
                                       <input type="text" class="form-control required" id="gender"  name="gender" maxlength="120" readonly value="<?php echo $viewclearance[0]->GENDER?>">
                                    </div>
                                </div>
                                   <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel No.</label>
                                       <input type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly value="<?php echo $viewclearance[0]->HOSTELID?>">
                                    </div>
                                  </div>
                                  <div class="col-md-3">                                
                                    <div class="form-group">
                                       <label for="hostel">Hostel Name</label>
                                        <input type="text" class="form-control required" id="hostelname" name="hostelname" maxlength="100" readonly value="<?php echo $viewclearance[0]->HOSTELDESC?>">
                                    </div>
                                  </div>
                                  
                            
                             <div class="col-md-2">                                
                                    <div class="form-group">
                                       <label for="hostel">Room No.</label>
                                        <input type="text" class="form-control required" id="roomno" name="roomno" maxlength="10" readonly value="<?php echo $viewclearance[0]->ROOMID?>">
                                        <input type="hidden" class="form-control required" id="roomid" name="roomid" maxlength="10" readonly >
                                    </div>
                                  </div>
                                  
                            <!-- <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="hostel">Room Type</label>
                                        <input type="text" class="form-control required" id="roomtype" name="roomtype" maxlength="10" readonly value="<?php //echo $viewclearance[0]->ROOMID?>">
                                    </div>
                                  </div>-->
                           <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="seatno">Seat</label>
                                        <input type="text" class="form-control required" id="seat" name="seat" maxlength="10" readonly value="<?php echo $viewclearance[0]->SEAT?>">
                                        <input type="hidden" class="form-control required" id="seatid" name="seatid" maxlength="10" readonly>
                                    </div>
                                  </div>
                            </div> <!-- Seat detail div end (div row end) -->
                           
                   <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Clearance Allocation Detail</h3>
                   </div>
                     <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="roomdesc">Seq#</label>
                                       <input type="text" class="form-control required" id="seq"  name="seq" maxlength="120" readonly value="<?php echo $viewclearance[0]->CLR_NO?>"> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Type</label>
                                         <input type="text" class="form-control required" id="type"  name="type" maxlength="120" value="<?php echo $viewclearance[0]->CLR_TYPE?>" readonly> 
                                         <!--<select class="form-control required" id="type" name="type">
                                             <option value="">Select Type</option>
                                            <option value="Alloted">Alloted</option>
                                            <option value="Attachi">Attachi</option>
                                            <option value="Employee">Employee</option>
                                        </select>-->
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Quota Type</label>
                                         <input type="text" class="form-control required" id="quotatype"  name="quotatype" maxlength="120" readonly value="<?php echo $viewclearance[0]->SEATSTATUS?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Semester Code</label>
                                        <input type="text" class="form-control required" id="semcode"  name="semcode" maxlength="120" readonly value="<?php echo $viewclearance[0]->SEMCODE?>">
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Leaving Date</label>
                                        <input type="date" class="form-control required" id="leavedate"  name="leavedate" maxlength="120" value="<?php echo $viewclearance[0]->LEAVE_DATE?>" >
                                    </div>
                                </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Alloted Date</label>
                                        <input type="text" class="form-control required" id="allotdate"  name="allotdate" maxlength="120" readonly value="<?php echo $viewclearance[0]->ALLOTEDDATE?>">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                              <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="doorkey">Retrun Room Items</label>
                                         <select class="form-control required" id="roomitem" name="roomitem">
                                            <option value="<?php echo $viewclearance[0]->SEAT?>"><?php $status = $viewclearance[0]->ROOMITEM; if($status == 1) echo 'Yes'; else 'No'?></option>
                                        </select>
                                    </div>
                                </div>
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cupkey">Cupboard Kyes</label>
                                          <select class="form-control required" id="cupkey" name="cupkey">
                                             <option value="<?php echo $viewclearance[0]->SEAT?>"><?php echo $viewclearance[0]->CUPBOARDKEYS?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="drawkey">Draw Kyes</label>
                                         <select class="form-control required" id="drawkey" name="drawkey">
                                            <option value="<?php echo $viewclearance[0]->SEAT?>"><?php echo $viewclearance[0]->DRAWKEYS?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="matress">Matress</label>
                                         <select class="form-control required" id="matress" name="matress">
                                            <option value="<?php echo $viewclearance[0]->SEAT?>"><?php echo $viewclearance[0]->MATRESS?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="chair">Chair</label>
                                         <select class="form-control required" id="chair" name="chair">
                                            <option value="<?php echo $viewclearance[0]->SEAT?>"><?php echo $viewclearance[0]->CHAIR?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="table">Table</label>
                                         <select class="form-control required" id="table" name="table">
                                            <option value="<?php echo $viewclearance[0]->SEAT?>"><?php echo $viewclearance[0]->TABLES?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="messdues">Mess Dues</label>
                                         <select class="form-control required" id="messdues" name="messdues">
                                            <option value="<?php echo $viewclearance[0]->MESSDUES?>"><?php $mess = $viewclearance[0]->MESSDUES; if($mess =1) echo 'Yes'; else echo 'No'?></option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="arriers">Arriers</label>
                                          <input type="number" class="form-control required" id="arrier" value="0"  name="arrier" maxlength="120" value="<?php echo $viewclearance[0]->ARRIERS?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="messdues">Clearance Status</label>
                                         <select class="form-control required" id="cstatus" name="cstatus">
                                             <<option value="<?php echo $viewclearance[0]->CSTATUS?>"><?php $cstatus =  $viewclearance[0]->CSTATUS; if($cstatus == 1) echo 'Yes'; else echo 'No'?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Clearance Date</label>
                                        <input type="date" class="form-control required" id="cleardate"  name="cleardate" maxlength="120" value="<?php echo $viewclearance[0]->CLR_DATE?>" >
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="expdate">Expiry Date</label>
                                        <input type="text" class="form-control required" id="expdate"  name="expdate" maxlength="120" value="<?php echo $viewclearance[0]->EXPIRYDATE?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="expdate">Fine Amount / FEES</label>
                                        <input type="text" class="form-control required" id="fine"  name="fine" maxlength="120" value="<?php echo $viewclearance[0]->FINEAMOUNT?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="messdues">Semester Type</label>
                                         <select class="form-control" id="semtype" name="semtype">
                                             <option value="<?php echo $viewclearance[0]->SEMTYPE?>"><?php echo $viewclearance[0]->SEMTYPE?></option>
                                        </select>
                                    </div>
                                </div>
                             </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <!--<input type="reset" class="btn btn-default" value="Reset" />-->
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

<script src="<?php echo base_url(); ?>assets/js/clear.js" type="text/javascript"></script>