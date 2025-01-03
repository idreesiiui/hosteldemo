<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Visitor Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <?php if(!empty($viewallotments)){
				$regno =  base64_encode( json_encode($viewallotments[0]->REGNO) );
				
				?>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>visitor/Visitor/addNew/<?php echo $regno?>">Add New</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Visitors List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
				
					if(empty($viewallotments[0]->VNAME))
					echo '<h4 style="color: red; text-align: center">No Visitors Existed agaisnt given RegNo </h4>';?>
              <table id="visiterList" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No#</th>
                      <th>STUDENT NAME</th>
                      <th>VISITOR NAME</th>
                      <th>VISITOR CNIC</th>
                      <th>VISITOR MOBILE</th>
                      <th>VISITOR ADDRESS</th>
                      <th>SEAT</th>
                      <th>Room No</th>
                      <th>Hostel No</th>
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
                      <td><?php echo $record->NAME ?></td>
                      <td><?php echo $record->VNAME ?></td>
                      <td><?php echo $record->VNICNO ?></td>
                      <td><?php echo $record->CONTACTNO ?></td>
                      <td><?php echo $record->VADDRESS ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->HOSTEL_NO ?></td>
                      <td>
                    <?php  if(!empty($record->VNAME)) {?>
                    
                          <a href="<?php echo base_url().'visitor/Visitor/editOld/'.$record->VISITORID; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!--<a href="#" data-allotid="<?php //echo $record->VISITORID; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>-->
                      
                      <?php }?>
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
    $(document).ready(function() {
    var table = $('#visiterList').DataTable( {
        lengthChange: false,
    "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
    aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
  
  table.buttons().container()
        .appendTo( '#visiterList_wrapper .col-sm-6:eq(0)' );

} );



 </script>