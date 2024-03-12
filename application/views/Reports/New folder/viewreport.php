<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Merit List
        <small>Add, Edit, Delete</small>
      </h1>
      <?php  
                     if (isset($studentInfo[0]->PROTITTLE)) { ?>
                    <a class="btn btn-primary" href="<?php echo base_url().'report/reports/printlist/'.$studentInfo[0]->PROTITTLE.$studentInfo[0]->SEMESTERCODE ?>" style="float:right; margin-top:-30px">Print Report</a> <?php }?>
               
    </section>
    <!--<section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php //echo base_url(); ?>addNew">Add New</a>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student List</h3>
                    <div class="box-tools">
                        <!--<form action="<?php //echo base_url() ?>StudentListings" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php //echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>-->
                    </div>
                </div><!-- /.box-header -->
                <!--<div class="box-body table-responsive no-padding">
                  <table class="table table-hover">-->
                  <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
				<thead>
                    <tr>
                      <th>SNo.</th>
                      <th>Student Name</th>
                      <th>Reg No</th>
                      <th>Programe</th>
                      <th>Distance</th>
                      <th>CGPA</th>
                      <th>Application Submit Date</th>
                      <th>Status</th>
                      <th>Tracker Id</th>
                      <th>Action</th>
                    </tr>
                 </thead>
                    <?php
                    if(!empty($studentInfo))
                    {
						$count = 1;
                        foreach($studentInfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $count ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->PROGRAME ?></td>
                      <td><?php echo $record->DISTANCE ?></td>
                      <td><?php echo $record->CGPA ?></td>
                      <td><?php echo $record->CREATEDDTM ?></td>
                      <td>
                          <a style="color:red"><?php if($record->STATUS == 0)
						  {echo "Pending";}elseif($record->STATUS == 1) echo '<span style="color:#1D6C3F;text-align:center;">Verified</span>'; elseif($record->STATUS == 2) echo '<span style="color:black;text-align:center;">Cancel</span>';?></a>
                      </td>
                      <td><?php echo $record->STUDENTID ?></td>
                      <td>
                     <a href="<?php echo base_url().'report/reports/verifystudentrecord/'.$record->STUDENTID?>"><i class="fa fa-pencil"></i></a>
                     
                      </td>
                    </tr>
                    <?php
                      $count++;  } 
					}
                  else{ 
					echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';} ?>
                  </table>
				  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    
                </div>
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
