<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Allotment List Report
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hostel Allotment List</h3>
                    
                    
                    <form class="form-horizontal" id="searchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getuserlist" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Programe</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="programe" id="programe">
                    <option value="">Select Programe </option>
                     <option value="Bachelor">Bachelor</option>
					 <option value="MS/MPHILL">MS/MPHILL</option>
                     <option value="PhD">PhD</option>
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
                  
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate Report" class="btn btn-primary"  />
                
                </div>
             </form>
              </div><!-- /.box -->
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
