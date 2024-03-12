<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Application List
        <small>View Application</small>
      </h1>
     
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
                   <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Applications</span>
          <span class="info-box-number"><?php echo '$totalapplication[0]->total'; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Verified Applications</span>
          <span class="info-box-number"><?php echo '$verifyapplication[0]->verify'; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pending Application</span>
          <span class="info-box-number"><?php echo' $pendingapplication[0]->pending'; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Cancel Application</span>
          <span class="info-box-number"><?php echo '$cancelapplication[0]->cancel'; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
  </div>
              
                            
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
                  <div id="feedback" style="float: left; width: 225px; display: none;" class="alert alert-success alert-dismissible">Rcords Save Successfully</div>
				  <?php 
				  if(isset($fromdate) && $fromdate != NULL && $todate != NULL && $status == 1) {?>
                  <div style="float:left; margin-left:10px">
                  <a class="btn btn-primary" href="<?php echo base_url().'report/reports/sendemailByDate/'.$studentInfo[0]->PROTITTLE.$studentInfo[0]->SEMESTERCODE.'/'.$fromdate.'/'.$todate.'/'.$status ?>">Send Email</a>
                  </div>
                  <?php } ?>
                  <div style="float:right; margin-right:10px">
                  
				  <?php  
                     if (isset($studentInfo[0]->PROTITTLE) && empty($programe)) { ?>
                    <a class="btn btn-primary" href="<?php echo base_url().'report/reports/printlist/'.$studentInfo[0]->PROTITTLE.'/'.$studentInfo[0]->SEMESTERCODE ?>">Print Report</a> <?php }
					elseif(isset($studentInfo[0]->PROTITTLE) && isset($programe))
					{
						
					?>
                    <a class="btn btn-primary" href="<?php echo base_url().'report/reports/printlist/'.$programe.$studentInfo[0]->SEMESTERCODE ?>">Print Report</a> <?php } ?>
                    </div>
                     <?php  
                     if (isset($studentInfo[0]->PROTITTLE)) { ?>
                  <h4 class="box-title" style="padding:10px; margin:auto; display:table">Student List of <strong style="text-decoration:underline"><?php if(empty($programe) && isset($programe)){echo $studentInfo[0]->PROTITTLE." ".$studseminfo[0]->SEMESTEROPENREG;} else {echo "("."All".")"." ".$studseminfo[0]->SEMESTEROPENREG;} if(isset($fromdate) && $fromdate != NULL && $todate != NULL)echo '('.$fromdate.') to '.'('.$todate.')'?></strong></h4><?php }?>
                  
                  <div id="feedback" style="color:green"></div>
                  <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
				<thead>
                    <tr>
                      <th>SNo.</th>
                      <th>Student Name</th>
                    <!--  <th>EMAIL</th>-->
                      <th>Reg No</th>
                      <th>Nationality</th>
                      <th>Province</th>
                      <th>Programe</th>
                      <th>Department</th>
                      <th>Distance</th>
                      <th>CGPA</th>
                      <th>Application Submit Date</th>
                      <th>Status</th>
                      <th>CStatus</th>
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
                      <!--<td><?php //echo $record->STUDENTEMAIL ?></td>-->
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->NATIONALITY ?></td>
                      <td><?php echo $record->PROVINCE ?></td>
                      <td><?php echo $record->PROGRAME ?></td>
                      <td><?php echo $record->DEPARTMENTNAME ?></td>
                      <td><?php echo $record->DISTANCE ?></td>
                      <td><?php echo $record->CGPA ?></td>
                      <td><?php echo $record->CREATEDDTM ?></td>
                      <td><?php if($record->STATUS == 0) {echo '<span style="color:#f39c12;">Pending'.'</span>';}elseif($record->STATUS == 1){ echo '<span style="color:#1D6C3F;">Verified'.'</span>'; }elseif($record->STATUS == 2) {echo '<span style="color:red;">'.'Cancel</span>';}?></td>
                      <td>
                          <?php if($record->STATUS == 0)
						?>
                        <select name="status[]" id="status" class="form-control selectboxit visible">
                        
                        <option value="1<?php echo $record->STUDENTID?>"<?php if($record->STATUS == '1'){echo "selected=selected";}?> style="color:green; font-weight:bold">Approved</option>
                        <option value="0<?php echo $record->STUDENTID?>"<?php if($record->STATUS == '0'){echo "selected=selected";}?> style="color:#FF8C00; font-weight:bold">Process</option>
                        <option value="2<?php echo $record->STUDENTID?>"<?php if($record->STATUS == '2'){echo "selected=selected";}?> style="color:red; font-weight:bold">Rejected</option>
                        </select>
						  
                      </td>
                      <td><?php echo $record->STUDENTID ?></td>
                      <td>
                     <a href="<?php echo base_url().'report/reports/verifystudentrecord/'.$record->STUDENTID?>" target="_blank"><i class="fa fa-pencil"></i></a>
                     
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reportallot.js" charset="utf-8"></script>
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
