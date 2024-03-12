<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Allotment History
        <small>View History</small>
      </h1>
      <!-- <div class="row">
            <div class="col-xs-12 text-right">
                 <a class="btn btn-primary" href="<?php //echo base_url(); ?>allotmenthistory/allotmenthistory/addNew">Add New</a>
            </div>
        </div>  -->
    </section>
    <section class="content">        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">View Allotment History Details</h3>   
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>allotmenthistory/allotmenthistory/viewAllotmentDetail" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>

                  <div class="col-sm-3">
                    <select class="form-control" required name="hostelno" id="hostelno">
                        <option value="">Select Hostel </option>
                         <?php
                            if(!empty($HostelRecords))
                            {
                                foreach ($HostelRecords as $records)
                                {
                                    ?>
                                    <option value="<?php echo $records->HOSTELID ?>">
                                        <?php echo $records->HOSTELDESC; ?>
                                    </option>
                                    <?php
                                }
                            }
                        ?>
                  </select>
                  </div>
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Rooms</label>

                  <div class="col-sm-2">
                     <select class="form-control" id="roomno" name="roomno">
                         <option value="">Select hostel first</option>      
                     </select>
                  </div>
                  <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-2">
                    <select class="form-control" required name="semester" id="semester">
                    <option value="">Select Semester </option>
                    <?php
                        if(!empty($SemesterRecords))
                        {
                            foreach ($SemesterRecords as $records)
                            {
                                ?>
                                <option value="<?php echo $records->SEMCODE; ?>">
                                    <?php echo $records->SEMCODE; ?>
                                </option>
                                <?php
                            }
                        }
                    ?>
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

<script src="<?php echo base_url(); ?>assets/js/allot-search.js" type="text/javascript"></script>

