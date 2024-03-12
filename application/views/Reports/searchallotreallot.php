<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Select Allot & ReAllot Report
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Allot Reallot List</h3>
                   
                    <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/allallot" >
              <div class="box-body">
                <div class="form-group">
                 
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Hostel</label>

                  <div class="col-sm-3">
                    <select class="form-control" name="hostelno" id="hostelno">
                    <option value="">Select Hostel</option>
                    <?php
                                            if(!empty($hostel))
                                            {
                                                foreach ($hostel as $hostels)
                                                {
                                                    ?>
                                                    <option value="<?php echo $hostels->HOSTELID ?>"><?php echo $hostels->HOSTELDESC ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                             <option value="All">All</option>
                    
                  </select>
                  </div>
                  
                   <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-3">
                    <select class="form-control" name="semester" id="semester">
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
                    						<option value="All">All</option>
                  </select>
                  </div>
                  
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate Report" class="btn btn-primary"  />
                
                </div>
             </form>
              
              <div class="box box-success"></div>
              
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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
