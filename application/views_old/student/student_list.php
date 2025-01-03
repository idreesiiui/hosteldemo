<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Contact Info Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Students List</h3>

                    <div class="col-md-12">
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
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> </div>
                    </div>
            </div>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 

                //var_dump($students);
				
					// if(empty($students[0]['USERID'])){
					// 	echo '<h4 style="color: red; text-align: center">
					// 	No Visitors Existed agaisnt given RegNo </h4>';
					// } ?>
              <table id="visiterList" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Student Name</th>
                      <th>Reg No#</th>
                      <th>Hostel Block</th>
                      <th>Room No</th>
                      <th>Contact No.</th>
                      <th>Email ID</th>
                      <th>Action</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($students))
                    {
						$sno = 1;
                        foreach($students as $record)
                        { 


							
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->STUDENTNAME; 
                      //var_dump($record); ?>
                        
                      </td>
                      <td><?php echo $record->REGNO; ?></td>
                      <td><?php echo $record->HOSTEL_NO; ?></td>
                      <td><?php echo $record->ROOMDESC.'/'.$record->SEAT; ?></td>
                      <td><?php echo $record->mobile; ?></td>
                      <td><?php echo $record->email; ?></td>
                      <td>
                          <a class="btn btn-primary" href="<?php echo base_url().'edit_student/'.base64_encode($record->REGNO); ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;Edit</a>
                          <!-- <a href="<?php //echo base_url().'delete-student/'.$record->REGNO; ?>" data-allotid="<?php //echo $record->REGNO; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a> -->
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