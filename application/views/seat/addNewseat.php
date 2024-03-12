<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Management
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
                        <h3 class="box-title">Enter Seat Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="seat" action="<?php echo base_url() ?>seat/seat/addNewseat" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostel">Hostel</label>
                                        <select class="form-control required" id="hostelno" name="hostelno">
                                            <option value=" ">Select Hostel</option>
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
                                    <label for="roomtype">Room No</label>
                                        <select class="form-control required" id="roomno" name="roomno">
                                        <option value="">Please select hostel first</option>    
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatdesc">Seat Desc</label>
                                        <select class="form-control required" id="seatdesc" name="seatdesc">
                                        <option value="">Please select Seat Desc</option> 
                                        <option value="Cubical">Cubical</option>
                                        <option value="Biseater">Biseater</option>
                                        <option value="Triseater">Triseater</option>
                                        <option value="Fourseater">Fourseater</option>
                                        <option value="Fiveseater">Fiveseater</option>
                                        <option value="Sixseater">Sixseater</option>
                                        <option value="Store">Store</option>
                                        <option value="Common">Common</option>
                                        <option value="Offices">Offices</option>   
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="occupy">Occupied</label>
                                        <select class="form-control required" id="seatoccupy" name="seatoccupy">
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seat">Seat</label>
                                        <select class="form-control required" id="seat" name="seat">
                                        <option value="">Please select Seat</option> 
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>   
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="S">S</option>  
                                        <option value="SA">SA</option> 
                                        <option value="SB">SB</option>  
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
<script src="<?php echo base_url(); ?>assets/js/seat.js" type="text/javascript"></script>