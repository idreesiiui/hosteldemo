<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attachment Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>attachment/attachment/addNew">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Attachment List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Alloted Reg No</th>
                      <th>Alloted Name</th>
                      <th>Attachi Reg No</th>
                      <th>Attachi Name</th>
                      <th>Hostel No</th>
                      <th>Room No</th>
                      <th>Seat</th>
                      <th>Key</th>
                      <th>Remarks</th>
                      <th>Attachment Date</th>
                      <th>Expiry Date</th>
                     <!-- <th>Status</th>-->
                    </tr>
              </thead>
                    <?php
                    if(!empty($viewattachments))
                    {
						$sno = 1;
                        foreach($viewattachments as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->HOSTREGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->ATTACHREGNO ?></td>
                      <td><?php echo $record->ATTACHNAME ?></td>
                      <td><?php echo $record->HOSTEL_NO?></td>
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->ATTACHKEY ?></td>
                      <td><?php echo $record->REMARKS ?></td>
                      <td><?php echo $record->ATTACHDATE ?></td>
                      <td><?php 
					  $todaydate = date('Y-m-d'); $expdate = $record->EXPIRYDATE;
                      if($expdate <= $todaydate)
					  {?>
						  <span class="label label-danger" style="font-size:13px;background-color:rgba(221, 75, 57, 0.79) !important"><?php echo $expdate;?></span>
                          
					  <?php }
					  else
					       echo $expdate;
					  ?>
                      </td>
                     <!-- <td>
                          <a href="<?php //echo base_url().'attachment/Attachment/editOld/'.$record->ATTACHMENT_ID; ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!--<a href="#" data-allotid="<?php //echo $record->ALLOTMENT_ID; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>-->
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
