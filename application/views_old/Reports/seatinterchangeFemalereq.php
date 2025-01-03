<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students  Seat InterChange List
        <small>Seat Change</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Seat InterChange Info List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <h4 style="margin-left:25%; margin-right:15%; text-decoration:underline"><?php if(isset($records[0]->SEMCODE)) echo 'Seat InterChange Application for Semester '.'<b>'.$records[0]->SEMCODE.'</b>';?></h4>
                <div id="feedback" style="float: left; width: 225px; display: none;" class="alert alert-success alert-dismissible">Rcords Save Successfully</div>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No</th>
                      <th>Student Name</th>
                      <th>Current(Room-seat/Hostel)</th>
                      <th>Swap Reg No</th>
                      <th>Swap Student Name</th>
                      <th>Applied For(Room-seat/Hostel)</th>
                      <th>Date/Time</th>
                      <th>Status</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($records))
                    {
						$sno = 1;
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td style="text-align:center"><?php echo $record->CROOM.'-'.$record->CSEAT.'/'.$record->CHOSTEL ?></td>
                      <td><?php echo $record->SWAPREGNO ?></td>
                      <td><?php echo $record->SWAPNAME ?></td>
      				  <td style="text-align:center"><?php echo $record->ROOM1.'-'.$record->SEAT1.'/'.$record->HOSTEL1 ?></td>
                      <td><?php echo $record->CREATEDDTM ?></td>
                      
                      <td>
                          <?php if($record->STATUS == 0)
						?>
                        <select name="status[]" id="status" class="form-control selectinterchange visible">
                        <option value="<?php echo $record->STATUS?>"><?php if($record->STATUS == 'Pending') {echo '<span style="color:#1D6C3F;">Pending'.'</span>';}elseif($record->STATUS == 'Approved'){ echo '<span style="color:#1D6C3F;">Approved'.'</span>'; }elseif($record->STATUS == 'Rejected') {echo '<span style="color:red;">'.'Rejected</span>';}?></option>
                        <option value="Approved<?php echo ','.$record->FSWAP_ID.','.$record->REGNO.','.$record->SWAPREGNO?>" style="color:green; font-weight:bold">Approved</option>
                        <option value="Pending<?php echo ','.$record->FSWAP_ID?>" style="color:#FF8C00; font-weight:bold">Pending</option>
                        <option value="Rejected<?php echo ',',$record->FSWAP_ID?>" style="color:red; font-weight:bold">Rejected</option>
                        </select>
						  
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
