<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Seat Setting
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                	<a class="btn btn-info" style="background-color:#367fa9 !important" href="<?php echo base_url(); ?>seat/seat/viewvacantSeatByHostel">Vacant Seat</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>seat/seat/addNew">Add New</a>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hostel Seat List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>seat/seat/viewSeatdetailinfo" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:48px" for="text" class="col-sm-2 control-label">Hostel:</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="hostelno" id="hostelno">
                    <option value="">Select Hostel </option>
                    <?php
                    if(!empty($HostelRecords))
                    {
                        foreach ($HostelRecords as $records)
                        {
                            ?>
                            <option value="<?php echo $records->HOSTELID ?>"><?php echo $records->HOSTELDESC ?></option>
                            <?php
                        }
                    }
                    ?>
                  </select>
                  </div>
                  <label style="width:45px" for="text" class="col-sm-2 control-label">Rooms:</label>

                  <div class="col-sm-2">
                     <select class="form-control" id="roomno" name="roomno">
                         <option value="">Please select hostel first</option>      
                     </select>
                  </div>
                   <label style="width:50px" for="text" class="col-sm-2 control-label">Seat Type:</label>

                   <div class="col-sm-2">
                    <select class="form-control" name="seatType" id="seatType">
                    <option value="">Seat Type</option>
                        <?php foreach($seattypes as $type ){ ?>
                     <option value="<?= $type->SEATDESC; ?>"><?= $type->SEATDESC; ?></option>
                        <?php } ?>
                     
                  </select>
                  </div>
                  <label style="width:60px" for="text" class="col-sm-2 control-label">Occupied:</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="occupy" id="occupy">
                    <option value="">Select Status</option>
                     <option value="1">yes</option>
					 <option value="0">no</option>
                  </select>
                  </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <!-- <input type="reset" class="btn btn-secondary" value="Reset"/> -->
                </div>
             </form>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

