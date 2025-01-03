<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Cradit Hours
        <small>View</small>
      </h1>      
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">View Student Cradit Hours Details</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>studentCraditHour/studentCraditHour/listCraditHours" >
              <div class="box-body">
                <div class="form-group">

                  <div class="col-md-4">
                    <label for="text" class="control-label">Enter Registration No</label>
                     <input class="form-control" type="text" name="regno" required>
                  </div>

                     <?php //var_dump($semester); ?>

                  <div class="col-md-4">
                  <label for="text" class="col-sm-2 control-label">Semester</label>
                    <select class="form-control" name="semester" id="semester" requird>
                    <option value="">Select Semester </option>
                     <?php

                    if(!empty($semester))
                    {
                        foreach ($semester as $records)
                        {
                            ?>
                            <option value="<?php echo $records['SEMCODE']; ?>"><?php echo $records['SEMCODE']; ?></option>
                            <?php
                        }
                    }
                    ?>
                  </select>
                  </div>
                  
                 
                <div class="col-md-4" style="text-align: left;">
                    <label style="display: block; opacity: 0;" for="text" class="control-label" requird > Action </label>
                        <input style="width: 80px;" type="submit" class="form-control btn btn-primary" value="Submit"/>
                      
                </div>
             </form>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/allot-search.js" type="text/javascript"></script>

