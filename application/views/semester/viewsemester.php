<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semester Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>semester/semester/addNew">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Semester List</h3>
                                                                  
                </div><!-- /.box-header -->
                <div  class="box-body ">
                  <!--<table class="table table-hover">--> 
                  <table id="semster" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Semester Code</th>
                      <th>Programe</th>
                      <th>Semester Start Date</th>
                      <th>Semester End Date</th>
                      <th>Start Reg Date</th>
                      <th>Start End Date</th>
                      <th>Registration Status</th>
                      <th>Status</th>
                      <th>Re-Allot Status</th>
                      <th>Actions</th>
                    </tr>
                   </thead>
                 
                    <?php
                    if(!empty($semesterRecords))
                    {
                        $sno = 1;
                        foreach($semesterRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->SEMCODE ?></td>
                      <td><?php echo $record->PROGRAME ?></td>
                      <td><?php echo $record->SMSTARTDATE ?></td>
                      <td><?php echo $record->SMENDDATE ?></td>
                      <td><?php echo $record->STARTREGDATE ?></td>
                      <td><?php echo $record->CLOSEREGDATE ?></td>
                      <td><?php if($record->APPSTATUS == 1) echo 'New Application'; else echo 'Re-Allotment'; ?></td>
                      <td><?php if($record->IS_ACTIVE == 1)echo 'Enable';else echo "Disable";?></td>
                       <td><?php if($record->REALLOTSTATUS == 1) echo 'Open'; else echo 'Close'; ?></td>
                      <td>
                          <a href="<?php echo base_url().'semester/semester/editsemester/'.$record->SMCODE; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-semid="<?php echo $record->SMCODE; ?>" class="deleteSemester"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                    $sno++;
                        }
                    }
                    else
                    echo "No Record Exist In database.";
                    ?>
                    
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">

jQuery(document).ready(function(){
    
    var table = $('#semster').DataTable( {
        lengthChange: false,
        
        "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
         table.buttons().container().appendTo( '#semster_wrapper .col-sm-6:eq(0)' );

});

</script>
