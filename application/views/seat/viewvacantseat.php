<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Seat Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
         <div class="col-md-4">
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
            <div class="col-xs-12 text-right">
                <div class="form-group">
                	<a class="btn btn-default" href="<?php echo base_url(); ?>seat/seat/viewvacantSeatByHostel">Back</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>seat/seat/addNew">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Seat Type List</h3>
                    
                </div><!-- /.box-header -->
                 <form role="form" id="seat" action="<?php echo base_url() ?>seat/seat/Updatevacantseatstatus" method="post" role="form">
                <div class="box-body">
                
               <table id="vacantSeats" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Hostel No.</th>
                      <th>Hostel Name</th>
                      <th>Room No</th>
                      <th>Seat Description</th>
                      <th>Seat</th>
                      <th>Occupied</th>
                      <!-- <th>Status</th> -->
                    </tr>
              </thead>
                    <?php
                    if(!empty($vacantseat))
                    {
						$sno = 1;
                        foreach($vacantseat as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->HOSTEL_NO ?></td>
                      <td><?php echo $record->HOSTELDESC ?></td>
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->SEATDESC ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php $occupied = $record->OCCUPIED;
                                       
					  if($occupied == 0){
						 echo '<span class="label label-success" style="font-size:13px">'."no".'</span>';
                    }else{
                        echo '<span class="label label-danger" style="font-size:13px">'."yes".'</span>';
                    }

                         ?>
                      
                                       
                     </td>
                     <!-- <td> 
                        <input type="checkbox" name="status[]" value="<?php //echo $record->SEATID?>">
                      <input type="hidden" name="hostelno" value="<?php //echo $record->HOSTELID?>"></td> -->
                    </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
                  </table>
                   <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                           
                        </div>
                    </form>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vacantseat.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });



        var table = $('#vacantSeats').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#vacantSeats_wrapper .col-sm-6:eq(0)' );
    });
</script>
