<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Semester Wise Allotment and Reallotment Report
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Total Hostel Students Allotment and Reallotment List</h3>
                   
              <div class="box-body">
                <div class="form-group">
                  

                <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getTotalHostelidListSemsterwise" >
                  
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-3">
                    <select required class="form-control" name="semester" id="semester">
                    <option value="">Select Semester</option>
                    <option value="all">All Semester</option>
                    <?php
                    if(!empty($semester))
                    {
                        foreach ($semester as $semesters)
                        {
                            ?>
                            <option value="<?= $semesters->SEMCODE;  ?>">
                                
                                <?= $semesters->SEMCODE; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                    
                  </select>
                  </div>
                  
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate Report" class="btn btn-primary"  />
                
                </div>
             </form>
              
              <div class="box box-success"></div>

              <h3 class="box-title">Hostel Students Allotment and Reallotment List</h3>
              <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getHosteliedList" >
                <label style="width:80px" for="text" class="col-sm-2 control-label">Allotment Type:</label>
                  <div class="col-sm-2">
                    <select required class="form-control" name="allotment_type" id="allotment_type">
                    <option value="">Select Allotment Type </option>
                     <option value="Allotment">Allotment</option>
                     <option value="ReAlloted">Reallotment</option>
                  </select>


                  </div>
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-3">
                    <select required class="form-control" name="semester" id="semester">
                    <option value="">Select Semester</option>
                    <?php
                    if(!empty($semester))
                    {
                        foreach ($semester as $semesters)
                        {
                            ?>
                            <option value="<?= $semesters->SEMCODE;  ?>">
                                
                                <?= $semesters->SEMCODE; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                    
                  </select>
                  </div>
                  
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate Report" class="btn btn-primary"  />
                
                </div>
             </form>




               <div class="box box-success"></div>
              <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getuserlistbydate" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Programe</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="programe" id="programe">
                    <option value="">Select Programe </option>
                     <option value="Bachelor">Bachelor</option>
					 <option value="MS/MPHILL">MS/MPHILL</option>
                     <option value="PhD">PhD</option>
                     <option value="All">All</option>
                  </select>
                  </div>
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-2">
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
                    
                  </select>
                  </div>
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="status" id="status">
                    <option value="">Select Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Verified</option>
                    <option value="2">Cancel</option>                               
                  </select>
                  </div>
                 </div>
                  <div class="box-body">
								<label style="width:55px" for="text" class="col-sm-2 control-label">From Date</label>
                                    <div class="col-sm-3"> 
                                        <input type="date" class="form-control" id="fromdate" name="fromdate">
                                    </div>
                               <label style="width:80px" for="text" class="col-sm-2 control-label">To Date</label>
                                    <div class="col-sm-3">
                                       
                                        <input type="date" class="form-control" id="todate" name="todate">
                                    </div>
                                                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate" class="btn btn-primary"  />
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
