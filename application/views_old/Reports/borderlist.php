<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Border List Report
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hostel Students Border List</h3>
              <div class="box box-success"></div>
              <form class="form-horizontal" id="borderList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getborderlist" >
           <div class="box-body">
              <div class="form-group">
                 <label for="hostel" style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="hostel" id="hostel" required>
                    <option value="">Select Hostel</option>
                       <?php
                        if(!empty($hostel))
                        {
                            foreach ($hostel as $record)
                            {
                                ?>
                                <option value="<?php echo $record->HOSTELID ?>"><?php echo $record->HOSTELDESC." (".$record->HOSTEL_NO.")" ?></option>
                                
                                <?php
                            }
                        }
                        ?>  
                    <option value="All">All</option>                            
                  </select>
                  </div>
                  <label for="faculty" style="width:80px" for="text" class="col-sm-2 control-label">Faculty</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="faculty" id="faculty" required>
                    <option value="">Select Faculty</option>
                   <?php
                        if(!empty($faculty))
                        {
                            foreach ($faculty as $record)
                            {
                                ?>
                                <option value="<?php echo $record->FACULTY_ID ?>"><?php echo $record->FNAME ?></option>
                                
                                <?php
                            }
                        }
                        ?>  
                        <option value="All">All</option>                            
                  </select>
                  </div>
                  <label for="dept" style="width:80px" for="text" class="col-sm-2 control-label">Department</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="dept" id="dept" required>
                    <option value="">Select Department</option>
                                                                      
                  </select>
                  </div>
                  <label for="programe" style="width:80px" for="text" class="col-sm-2 control-label">Programe</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="programe" id="programe" required>                        
                    <option value="">Select Programe </option>
                     <option value="BS">Bachelor</option>
                     <option value="MSC">MSC</option>
					 <option value="MS/MPHILL">MS/MPHILL</option>
                     <option value="PhD">PhD</option>
                     <option value="All">All</option>
                  </select>
                    </div>
                  </div>
                <div class="form-group">   
                  <label for="nationality" style="width:80px" for="text" class="col-sm-2 control-label">Nationality</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="nationality" id="nationality" required>
                    <option value="">Select Nationality </option>
                     <!-- <option value="Pakistani">Pakistani</option> -->
					 <!-- <option value="Overseas Pakistani">Overseas Pakistani</option> -->
                     <!-- <option value="Foreigner">Foreigner</option> -->
                     <?php foreach($nationalities as $nationality){ ?>
                         <option value="<?php echo $nationality->NATIONALITY; ?>"><?php echo $nationality->NATIONALITY; ?></option>
                     <?php } ?>
                     <option value="All">All</option>
                  </select>
                  </div>
                  <label for="semester" style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="semester" id="semester" required>
                    <option value="">Select Semester</option>
                    <?php
                    if(!empty($semester))
                    {
                        foreach ($semester as $semesters)
                        {
                            ?>
                            <option value="<?php echo $semesters->SEMCODE ?>"><?php echo $semesters->SEMCODE ?></option>
                            <?php
                        }
                    }
                    ?>
                    
                  </select>
                  </div>                                
                </div>
                <br>
              <div class="row>">
              <div class="form-group" style="margin-right: 35px; float:right">
                <input type="submit" class="btn btn-primary" value="Genrate Report"  />
                   </div>
                </div>
             </form>
              </div><!-- /.box -->
              <div class="col-md-6">
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

            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/borderlist.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
