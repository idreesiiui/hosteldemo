<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Allotment Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <a style="float:left !important" class="btn btn-default" href="<?php echo base_url(); ?>allotment/Allotment/view">Back</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>allotment/Allotment/ViewDefaulter">View Defaulter List</a>
                    <!--<a class="btn btn-danger" href="<?php //echo base_url(); ?>allotment/Allotment/GenrateDefaulterList">Genrate Defaulter List</a>-->
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>allotment/Allotment/addNew">Add New</a>
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
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Allotment List</h3>
                </div><!-- /.box-header -->
            <div class="box-body">
              <table id="allotmentHistory" class="table table-bordered table-striped">
                 <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No#</th>
                      <th>STUDENT NAME</th>
                      <th>Email</th>
                      <th>Hostel No</th>
                      <th>Room No</th>
                      <th>Room Type</th>
                      <th>Seat</th>
                      <th>Alloted Date</th>
                      <th>Expire Date</th>
                      <th>Country</th>
                      <th>Fee Amount</th>
                      <th>HOSTEL BATCH</th>
                      <th>Key</th>
                      <th>Admin Status</th>
                      <th>Upload Status</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                    <?php 
                    if(!empty($viewallotments))
                    {
						$sno = 1;
                        foreach($viewallotments as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo $record->REGNO; ?></td>
                      <td><?php echo $record->STUDENTNAME; ?></td>
                      <td><?php echo $record->email; ?></td>
                      <td><?php echo $record->HOSTEL_NO; ?></td>
                      <td><?php echo $record->ROOMDESC; ?></td>
                      <td><?php echo $record->ROOMTYPE; ?></td>
                      <td><?php echo $record->SEAT;//.'='.$record->OCCUPIED; ?></td>
                      <td><?php echo $record->ALLOTEDDATE; ?></td>
                      <td><?php 
					  $todaydate = date('y-m-d'); 
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
                      <td><?php echo $record->COUNTRY; ?></td>
                      <td><?php echo $record->FEEAMOUNT; ?></td>
                      <td><?php echo $record->HOSTELBATCH; ?></td>
                      <td>
					  <?php
					   $regno = $record->REGNO;
					   $gender = $record->GENDER;
					   $CI =& get_instance();
					   $keyinfo = $CI->allotment_model->getkeyInfo($regno, $gender);

					   if(empty($keyinfo[0]->KEY) || $keyinfo[0]->KEY == null || $keyinfo[0]->KEY == ''){ ?>
                        <a target="_blank" href="<?php echo base_url().'allotment/Allotment/updateKey/'.base64_encode($record->REGNO); ?>">Update Key</a>

                      <?php
                      }else{
                            echo $keyinfo[0]->KEY;
                        } 
					  ?>
					  </td> 
                      <td><?php 
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
                      </td>
                       <td>
                       <?php 
					 if($record->IS_SUBMIT == 1)
					  {
					  ?>
                       <span class="bg-green color-palette"><?php echo 'Uploded'; ?></span><?php }else{?>
                        
                       <span class="bg-yellow color-palette"><?php echo 'Pending';?></span><?php }?>
                      </td>
                      <td>
                          <a href="<?php echo base_url().'allotment/Allotment/editOld/'.$record->ALLOTMENT_ID.'/'.$hostelno.'/'.$roomno ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                      <!--    <a href="#" data-allotid="<?php //echo $record->ALLOTMENT_ID; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
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

        var table = $('#allotmentHistory').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#allotmentHistory_wrapper .col-sm-6:eq(0)' );

    });
</script>
