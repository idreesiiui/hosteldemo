
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Allotment Report Setting
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Alloted List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/viewAllotinfo" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>

                  <div class="col-sm-3">
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
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Rooms</label>

                  <div class="col-sm-2">
                     <select class="form-control required" id="roomno" name="roomno">
                         <option value="">Select Hostel First</option>      
                     </select>
                  </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
             <div class="box box-success"></div>
             <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>seat/seat/viewSeatdetailinfo" >
              <div class="box-body">
              <label style="width:73px" for="text" class="col-sm-2 control-label">Reg No</label>
     				<div class="col-sm-3">
                     <input type="text" class="form-control required" id="fname" name="fname" maxlength="128">

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

<script src="<?php echo base_url(); ?>assets/js/reportseat-setting.js" type="text/javascript"></script>

