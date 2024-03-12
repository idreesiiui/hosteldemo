<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clearance Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
          <div class="col-xs-6 text-left">
               <div class="form-group">
                 <a class="btn btn-default" href="<?php echo base_url(); ?>clearance/clearance/viewclearance">Back</a>
                </div>
             </div>             
            <div class="col-xs-6 text-right">
                  <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>clearance/clearance/addNew">Add New</a>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Clearance List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="viewClearanceDetail" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No#</th>
                      <th>STUDENT NAME</th>
                      <th>Hostel No#</th>
                      <th>Hostel Name</th>
                      <th>Room No#</th>
                      <th>SEAT</th>
                      <th>Clearance Date</th>
                      <th>Status</th>
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
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->HOSTEL_NO; ?></td>
                      <td><?php echo $record->HOSTELDESC ?></td>
                      <td><?php echo $record->ROOMID ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->CLR_DATE ?></td>
                      <td>
                          <a href="<?php echo base_url().'clearance/Clearance/viewstudentclearance/'.$record->CLR_NO; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="<?php echo base_url().'clearance/Clearance/studentclearslip/'.$record->CLR_NO; ?>"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!--<a href="#" data-allotid="<?php //echo $record->ALLOTMENT_ID; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>-->
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

            var table = $('#viewClearanceDetail').DataTable( {
            lengthChange: false,
            "scrollX": false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
        } );
            table.buttons().container().appendTo( '#viewClearanceDetail_wrapper .col-sm-6:eq(0)' );
    });
</script>
