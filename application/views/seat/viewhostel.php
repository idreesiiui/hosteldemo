<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Hostel Vacant Seat
        <small>View</small>
      </h1>
    </section>
    <section class="content">
       
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hostel Seat List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>seat/seat/viewvacantSeat" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>

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
                                            <option value="All">All</option>
                  </select>
                  </div>
                 
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

