<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>hostel/hostel/addNew">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
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
            </div>
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hostel Block List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="hostelDetail" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Hostel No.</th>
                      <th>Hostel Description</th>
                      <th>Room Capacity</th>
                      <th>Seat Capacity</th>
                      <th>Floors</th>
                      <th>Gender</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($hostelRecords))
                    {
                        $sno = 1;
                        foreach($hostelRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->HOSTEL_NO ?></td>
                      <td><?php echo $record->HOSTELDESC ?></td>
                      <td><?php echo $record->ROOMCAPACITY ?></td>
                      <td><?php echo $record->SEATCAPACITY ?></td>
                      <td><?php echo $record->FLOORS ?></td>
                      <td><?php echo $record->GENDER ?></td>
                      <td>
                          <a href="<?php echo base_url().'hostel/hostel/editOld/'.$record->HOSTELID; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="<?php echo base_url().'hostel/hostel/deletehostel/'.$record->HOSTELID; ?>" onclick="return confirm('Are you sure you want to delete this hostel?');" class="deleteHostel"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
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
        // jQuery('ul.pagination li a').click(function (e) {
        //     e.preventDefault();            
        //     var link = jQuery(this).get(0).href;            
        //     var value = link.substring(link.lastIndexOf('/') + 1);
        //     jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
        //     jQuery("#searchList").submit();
        // });

         var table = $('#hostelDetail').DataTable( {
        lengthChange: false,
        "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
         table.buttons().container().appendTo( '#hostelDetail_wrapper .col-sm-6:eq(0)' );
    });
</script>
