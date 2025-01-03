<?php

$hostelno = '';
$hosteldesc = '';
$roomcap = '';
$seatcap = '';
$floors = '';
$gender = '';
$HostelId = '';

if(!empty($hostelInfo))
{
    foreach ($hostelInfo as $uf)
    {
        $HostelId = $uf->HOSTELID;
		$hostelno = $uf->HOSTEL_NO;
        $hosteldesc = $uf->HOSTELDESC;
        $roomcap = $uf->ROOMCAPACITY;
        $seatcap = $uf->SEATCAPACITY;
        $floors = $uf->FLOORS;
		$gender = $uf->GENDER;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                     <form role="form" id="hostel" action="<?php echo base_url() ?>hostel/hostel/editHostel" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">Hostel No.</label>
                                        <input type="number" class="form-control required" id="hostelno" name="hostelno" maxlength="10" value="<?php echo  $hostelno?>">
                                        <input type="hidden" class="form-control required" id="hostelid" name="hostelid" maxlength="10" value="<?php echo  $HostelId?>">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hosteldesc">Hostel Desc</label>
                                        <input type="text" class="form-control required" id="hosteldesc"  name="hosteldesc" maxlength="128" value="<?php echo  $hosteldesc?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomcap">Room Capacity</label>
                                        <input type="number" class="form-control required" id="roomcap"  name="roomcap" maxlength="10" value="<?php echo  $roomcap?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatcap">Seat Capacity</label>
                                        <input type="number" class="form-control required" id="seatcap" name="seatcap" maxlength="10" value="<?php echo  $seatcap?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floors">Floors</label>
                                        <input type="number" class="form-control required" id="floors" name="floors" maxlength="10" value="<?php echo  $floors?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">gender</label>
                                        <select class="form-control required" id="gender" name="gender" >
                                            <option value="<?php echo  $gender?>"><?php echo  $gender?></option>
                                           	<option value="Male">Male</option>
                                            <option value="Female">Female</option>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>