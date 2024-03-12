<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Visitors Search
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Visitors List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>visitor/Visitor/viewVisitorDetailbyId" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Reg No.</label>

                  <div class="col-sm-2">
                     <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120">
                  </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
             <div class="box box-success"></div>
              <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>visitor/Visitor/viewVisitorDetailbyHostel" >
              <div class="box-body">
                
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>

                  <div class="col-sm-3">
                    <select class="form-control required" name="hostelno" id="hostelno">
                    <option value="">Select Hostel</option>
                    <?php
                                            if(!empty($hostel))
                                            {
                                                foreach ($hostel as $hostels)
                                                {
                                                    ?>
                                                    <option value="<?php echo $hostels->HOSTELID ?>"><?php echo $hostels->HOSTELDESC.'('.$hostels->HOSTEL_NO.')' ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                    
                  </select>
                  </div>
                  
                  <div class="col-sm-2">
                    <select class="form-control required" name="roomno" id="roomno">
                    <option value="">Select Room No.</option>
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

