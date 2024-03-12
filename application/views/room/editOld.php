<?php

$hostelno = '';
$roomid = '';
$hosteldesc = '';
$roomdesc = '';
$roomtype = '';
$seatcap = '';
$floor = '';
$bed = '';
$chair = '';
$table = '';
$cupboard = '';
$tubelight = '';
$fan = '';
$otheritem = '';

if(!empty($roomInfo))
{
    foreach ($roomInfo as $uf)
    {
        $hostelno = $uf->HOSTEL_NO;
		$hostelid = $uf->HOSTELID;
		$roomid = $uf->ROOMID;
		$hosteldesc = $uf->HOSTELDESC;
		$roomdesc = $uf->ROOMDESC;
        $roomtype = $uf->ROOMTYPE;
        $seatcap = $uf->SCAPACITY;
        $floor = $uf->FLOOR;
        $bed = $uf->BEDS;
		$chair = $uf->CHAIRS;
		$table = $uf->TABLES;
		$cupboard = $uf->CUPBOARDS;
		$tubelight = $uf->TUBELIGHTS;
		$fan = $uf->FANS;
		$otheritem = $uf->OTHERITEMS;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Room Management
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
                        <h3 class="box-title">Edit Room Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="room" action="<?php echo base_url() ?>room/room/editRoom" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel</label>
                                        <select class="form-control required" id="hostel" name="hostelno">
                                           	<option value="<?php echo $hostelid?>"><?php echo $hosteldesc?></option>
                                             <?php
                                            if(!empty($hosteldetail))
                                            {
                                                foreach ($hosteldetail as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->HOSTELID ?>"><?php echo $rl->HOSTELDESC ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomdesc">Room Desc</label>
                                        <input type="text" class="form-control required" id="roomdesc"  name="roomdesc" maxlength="128" value="<?php echo $roomInfo[0]->ROOMDESC?>">
                                        <input type="hidden" class="form-control required" id="roomid"  name="roomid" maxlength="128" value="<?php echo $roomid?>">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomtype">Room Type</label>
                                        <input type="text" class="form-control required" id="roomtype"  name="roomtype" maxlength="10" value="<?php echo $roomtype?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatcap">Seat Capacity</label>
                                        <input type="number" class="form-control required" id="seatcap" name="seatcap" maxlength="10" value="<?php echo $seatcap?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floors">Floors</label>
                                        <input type="number" class="form-control required" id="floors" name="floors" maxlength="10" value="<?php echo $floor?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="beds">Beds</label>
                                        <input type="number" class="form-control required" id="bed" name="bed" maxlength="10" value="<?php echo $bed?>">
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chair">Chairs</label>
                                        <input type="number" class="form-control required" id="chair" name="chair" maxlength="10" value="<?php echo $chair?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="beds">Tables</label>
                                        <input type="number" class="form-control required" id="tables" name="tables" maxlength="10" value="<?php echo $table?>">
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cupboards">Cupboards</label>
                                        <input type="number" class="form-control required" id="cupboards" name="cupboards" maxlength="10" value="<?php echo $cupboard?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tubelight">TubeLights</label>
                                        <input type="number" class="form-control required" id="tubelight" name="tubelight" maxlength="10" value="<?php echo $tubelight?>">
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fans">Fans</label>
                                        <input type="number" class="form-control required" id="fan" name="fan" maxlength="10" value="<?php echo $fan?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="otheritem">Other Items</label>
                                        <input type="number" class="form-control required" id="otheritem" name="otheritem" maxlength="10" value="<?php echo $otheritem?>">
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="otheritem">Capture By</label>
                                        <select name="CAPTUREBY" class="form-control required">
                                            <option value="JTI">JTI ( Jamiat Tulba Islam ) </option>
                                            <option value="ATI">ATI ( Anjuman Tulba Islam ) </option>
                                            <option value="PSF">PSF (Pashtoon Student Federation) </option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div> -->

                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <!-- <input type="reset" class="btn btn-default" value="Reset" /> -->
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