<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students Allotment & ReAllotment
        <small>Seat Allotment</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Info List</h3>
                      <a class="btn btn-primary clear" style="float:right !important" href="#<?php //echo base_url().'report/reports/gendefaultlist'; ?>" data-userid="<?php echo '1'; ?>">Vacant Seat</a>
                      <a class="btn btn-danger" style="float:right !important" href="<?php echo base_url(); ?>report/reports/cancelreallot">Cancel Defaulter</a>
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>UserId</th>
                      <th>Reg No#</th>
                      <th>STUDENT NAME</th>
                      <th>Hostel No</th>
                      <th>Room No</th>
                      <th>Room Type</th>
                      <th>Seat</th>
                      <th>Alloted Date</th>
                      <th>Expire Date</th>
                      <th>Country</th>
                      <!--<th>Admin Status</th>-->
                      <th>First Allotment</th>
                      <th>Action</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($allotinfo))
                    {
						$sno = 1;
                        foreach($allotinfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->EMAILID ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->HOSTEL_NO ?></td>
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->ROOMTYPE ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->ALLOTEDDATE ?></td>
                      <td><?php 
					  $todaydate = date('d-m-y'); 
					  $todaydate = str_replace('-', '/', $todaydate);
					  $expdate = $record->EXPIRYDATE;
                      if($expdate <= $todaydate)
					  {?>
						  <span class="label label-danger" style="font-size:13px;background-color:rgba(221, 75, 57, 0.79) !important"><?php echo $expdate;?></span>
                          
					  <?php }
					  else
					       echo $expdate;
					  ?>
                      </td>
                      <td><?php echo $record->COUNTRY ?></td>
                      <!--<td><?php 
                      if($record->ADMIN_VERIFY == 0)
					  {?>
						  <span class="bg-yellow color-palette"><?php echo 'Pending';?></span>
                          
					  <?php }
					  else if($record->ADMIN_VERIFY == 1)
					  {
					  ?> 
					      <span class="bg-green-active color-palette"><?php echo 'Verified';?></span>
                       <?php }
					  else if($record->ADMIN_VERIFY == 2)
					  {
					  ?>
                       <span class="bg-red color-palette"><?php echo 'Cancel'; }?></span>
                      </td>-->
                       <td>
                       <?php echo $record->HOSTELBATCH; ?>
                       <?php 
					    /* if($record->EXT == 0){
						    ?><span class="bg-green-active color-palette"> <?php echo 'No Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 1){
							  ?><span class="bg-yellow-active color-palette"> <?php echo '1st Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 1){
							  ?><span class="bg-yellow-active color-palette"> <?php echo '2nd Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 1){
							  ?><span class="bg-yellow-active color-palette"> <?php echo '3rd Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 1){
							  ?><span class="bg-yellow-active color-palette"> <?php echo '4th Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 1){
							  ?><span class="bg-yellow-active color-palette"> <?php echo '5th Ext'; ?></span>
                          <?php
						  }
						  elseif($record->EXT == 6){
							   ?><span class="bg-red-active color-palette"> <?php echo 'Blocked Ext';?></span>
                          <?php  
						  }*/
					   ?>
                      </td>
                     <td>
                          <a href="<?php echo base_url() ?>reallotment/ReAllotment/revertAllallot/<?php echo $record->ID ?>"><i class="fa fa-arrow-circle-right">Revert</i>&nbsp;&nbsp;&nbsp;</a>
                      
                    </td>
                    </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                
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
